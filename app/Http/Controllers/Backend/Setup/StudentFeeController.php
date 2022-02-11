<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $data = StudentFee::all();
        return view('backend.setup.student_fee.view_fee', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.student_fee.add_fee');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_fees,name'
        ]);

        $data = new StudentFee();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.fee.view')->with($notification);
    }

    public function edit($id)
    {
        $fee = StudentFee::find($id);
        return view('backend.setup.student_fee.edit_fee', compact('fee'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentFee::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Fee Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.fee.view')->with($notification);
    }

    public function delete($id)
    {
        $fee = StudentFee::find($id)->delete();
        $notification = array(
            'message' => 'Fee Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.fee.view')->with($notification);
    }
}
