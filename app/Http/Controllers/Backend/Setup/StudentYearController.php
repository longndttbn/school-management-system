<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentYearController extends Controller
{
    //
    public function view()
    {
        // $id = Auth::user()->id;
        $data = StudentYear::all();
        return view('backend.setup.student_year.view_year', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.student_year.add_year');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name'
        ]);

        $data = new StudentYear();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function edit($id)
    {
        $year = StudentYear::find($id);
        return view('backend.setup.student_year.edit_year', compact('year'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentYear::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Year Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function delete($id)
    {
        $year = StudentYear::find($id)->delete();
        $notification = array(
            'message' => 'Year Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
}
