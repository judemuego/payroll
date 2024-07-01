<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\Supplier;
use App\Site;
use App\EmployeeInformation;
use Illuminate\Http\Request;
use Auth;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $employees = EmployeeInformation::orderBy('id', 'desc')->get();
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        $sites = Site::orderBy('id', 'desc')->get();
        return view('backend.pages.purchasing.transaction.purchase_order.index', compact('employees', 'suppliers', 'sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => ['required', 'integer'],
            'delivery_date' => ['required', 'date'],
            'site_id' => ['required', 'integer'],
            'po_date' => ['required', 'date'],
            'contact_no' => ['required', 'string'],
            'reference' => ['required', 'string'],
            'terms' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'order_no' => ['required', 'string'],
            'tax_type' => ['required', 'string'],
            'subtotal' => ['required', 'numeric'],
            'total_with_tax' => ['required', 'numeric'],
            'delivery_instruction' => ['required', 'string'],
        ]);

        $request['prepared_by'] = Auth::user()->workstation_id;
        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        PurchaseOrder::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(PurchaseOrder::with('supplier', 'site', 'prepared_by', 'reviewed_by', 'approved_by', 'received_by', 'details')->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {
        $purchase_orders = PurchaseOrder::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('purchase_orders'));
    }

    public function print($id)
    {
        $purchase_orders = PurchaseOrder::with('supplier', 'site', 'prepared_by', 'reviewed_by', 'approved_by', 'received_by', 'details')->where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('purchase_orders'));
    }

    public function update(Request $request, $id)
    {
        PurchaseOrder::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            PurchaseOrder::find($item)->delete();
        }

        return 'Record Deleted';
    }
}
