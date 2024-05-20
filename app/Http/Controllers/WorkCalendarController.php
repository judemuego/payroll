<?php

namespace App\Http\Controllers;

use Auth;
use App\WorkCalendar;
use Illuminate\Http\Request;

class WorkCalendarController extends Controller
{
    public function save(Request $request, $id) {
        $request['updated_by'] = Auth::user()->id;

        WorkCalendar::where('employee_id', $request->employee_id)->update($request->except('_token'));

        return response()->json();
    }
}
