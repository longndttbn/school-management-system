<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class SchoolSubjectController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $data = SchoolSubject::all();
        return view('backend.setup.school_subject.view_subject', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.school_subject.add_subject');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name'
        ]);

        $data = new SchoolSubject();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    public function edit($id)
    {
        $subject = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_subject', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $data = SchoolSubject::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    public function delete($id)
    {
        $subject = SchoolSubject::find($id)->delete();
        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }
}
