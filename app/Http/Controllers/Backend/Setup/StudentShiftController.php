<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentShiftController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $data = StudentShift::all();
        return view('backend.setup.student_shift.view_shift', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.student_shift.add_shift');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name'
        ]);

        $data = new StudentShift();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Shift Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function edit($id)
    {
        $shift = StudentShift::find($id);
        return view('backend.setup.student_shift.edit_shift', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentShift::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Shift Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function delete($id)
    {
        $shift = StudentShift::find($id)->delete();
        $notification = array(
            'message' => 'Shift Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
}
