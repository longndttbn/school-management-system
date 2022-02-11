<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamTypeController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $data = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', compact('data'));
    }

    public function add()
    {
        # code...
        return view('backend.setup.exam_type.add_exam_type');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name'
        ]);

        $data = new ExamType();

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.view')->with($notification);
    }

    public function edit($id)
    {
        $exam_type = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('exam_type'));
    }

    public function update(Request $request, $id)
    {
        $data = ExamType::find($id);
        $data->name = $request->name;

        $data->save();

        $notification = array(
            'message' => 'Exam Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.view')->with($notification);
    }

    public function delete($id)
    {
        $exam_type = ExamType::find($id)->delete();
        $notification = array(
            'message' => 'Exam Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
