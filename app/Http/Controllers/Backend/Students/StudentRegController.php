<?php

namespace App\Http\Controllers\Backend\Students;

use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use Illuminate\Support\Facades\DB;
use App\Models\StudentRegistration;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentRegController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        $allData['years'] = StudentYear::all();
        $allData['classes'] = StudentClass::all();
        $allData['year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        $allData['class_id'] = StudentClass::orderBy('id','desc')->first()->id;

        $allData['data'] = AssignStudent::where('year_id',$allData['year_id'])->where('class_id', $allData['class_id'])->get();

        return view('backend.student.student_reg.student_view', $allData);
    }

    public function add()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        return view('backend.student.student_reg.student_add', $data);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $studentYear = StudentYear::find($request->year_id);
            $checkYear = $studentYear->name;
            $student = User::where('type', 'student')->orderBy('id', 'DESC')->first();
            if ($student == null) {
                $firstReg = 0;
                $studentID = $firstReg + 1;
                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 10000) {
                    $id_no = '0' . $studentID;
                }
            } else {
                $student = User::where('type', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentID = $student + 1;
                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 10000) {
                    $id_no = '0' . $studentID;
                }
            }

            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->type = 'Student';
            $user->code = $code;
            $user->name = $request->student_name;
            $user->fname = $request->father_name;
            $user->mname = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->date));


            if ($request->file('image')) {
                $file = $request->file('image');
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $fileName);
                $user['image'] = $fileName;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student Registration Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function search(Request $request)
    {
        $allData['years'] = StudentYear::all();
        $allData['classes'] = StudentClass::all();
        $allData['year_id'] = $request->year_id;
        $allData['class_id'] = $request->class_id;
        $allData['data'] = AssignStudent::where('year_id',$allData['year_id'])->where('class_id', $allData['class_id'])->get();

        return view('backend.student.student_reg.student_view', $allData);
    }

    public function edit($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editStudent'] = AssignStudent::with(['student', 'discount', 'student_class', 'student_year'])->where('student_id', $student_id)->first(); // hamf trong with dc viet trong Model

        // dd($data['editStudent'] -> toArray());

        return view('backend.student.student_reg.student_edit', $data);
    }

    public function update(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();

            $user->name = $request->student_name;
            $user->fname = $request->father_name;
            $user->mname = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->date));


            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $fileName);
                $user['image'] = $fileName;
            }

            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function details($student_id)
    {
        $data['details'] = AssignStudent::with(['student']['discount'])->where('student_id', $student_id)->first();

    }

   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF()

    {
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',

        //     'date' => date('m/d/Y')
        // ];

        // $pdf = \PDF::loadView('myPDF', $data);
        // return $pdf->download('itsolutionstuff.pdf');

    }
}
