<?php

namespace App\Http\Controllers;

use App\PurchaseOrderDetail;
use App\PurchaseOrder;
use App\Supplier;
use App\Site;
use App\EmployeeInformation;
use Illuminate\Http\Request;
use Auth;

class PurchaseOrderDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => ['required', 'integer'],
            'item' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'tax_rate' => ['required', 'string'],
            'total_amount' => ['required', 'numeric'],
            'split' => ['nullable', 'string'],
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        PurchaseOrderDetail::create($request->all());

        $record = PurchaseOrder::where('id', $request->purchase_order_id)->firstOrFail();

        $total = $record->sub_total + $request->total_amount;
        PurchaseOrder::find($request->purchase_order_id)->update(['subtotal' => $total, 'total_with_tax' => $total]);

        return redirect()->back()->with('success','Successfully Added');
    }

    public function get($id) {
        if(request()->ajax()) {
            return datatables()->of(PurchaseOrderDetail::with('purchase_order')->where('purchase_order_id', $id)->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {
        $purchase_order_details = PurchaseOrderDetail::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('purchase_order_details'));
    }

    public function update(Request $request, $id)
    {
        PurchaseOrderDetail::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            PurchaseOrderDetail::find($item)->delete();
        }

        return 'Record Deleted';
    }
}
