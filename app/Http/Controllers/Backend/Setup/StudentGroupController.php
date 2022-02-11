<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentGroupController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $data = StudentGroup::all();
        return view('backend.setup.student_group.view_group', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.student_group.add_group');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name'
        ]);

        $data = new StudentGroup();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Group Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function edit($id)
    {
        $group = StudentGroup::find($id);
        return view('backend.setup.student_group.edit_group', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $data = StudentGroup::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Group Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function delete($id)
    {
        $group = StudentGroup::find($id)->delete();
        $notification = array(
            'message' => 'Group Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}
