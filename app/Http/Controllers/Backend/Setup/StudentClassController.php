<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    //
    public function view()
    {
        // $id = Auth::user()->id;
        $data = StudentClass::all();
        return view('backend.setup.student_class.view_class', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.student_class.add_class');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name'
        ]);

        $data = new StudentClass();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function edit($id)
    {
        $class = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentClass::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Class Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function delete($id)
    {
        $class = StudentClass::find($id)->delete();
        $notification = array(
            'message' => 'Class Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
