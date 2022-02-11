<?php

namespace App\Http\Controllers\Backend\Setup;

use Carbon\Carbon;
use App\Models\FeeAmount;
use App\Models\StudentFee;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeAmountController extends Controller
{
    public function view()
    {
        // $id = Auth::user()->id;
        // $data = FeeAmount::all();
        $data = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_amount', compact('data'));
    }

    public function add()
    {
        $fee_categories = StudentFee::all();
        $classes = StudentClass::all();
        return view('backend.setup.fee_amount.add_amount', compact('fee_categories', 'classes'));
    }

    public function store(Request $request)
    {

        $countClasses = count($request->class_id);

        if ($countClasses != null) {
            for ($i = 0; $i < $countClasses; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }

        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function edit($fee_category_id)
    {
        $data = FeeAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();

        // dd($data->toArray());
        $fee_categories = StudentFee::all();
        $classes = StudentClass::all();
        return view('backend.setup.fee_amount.edit_amount', compact('fee_categories', 'classes', 'data'));
    }

    public function update(Request $request, $fee_category_id)
    {
        if ($request->class_id == null) {
            $notification = array(
                'message' => 'Sorry, You do not select any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.edit')->with($notification);
        } else {
            $countClasses = count($request->class_id);

            $data = FeeAmount::where('fee_category_id', $fee_category_id)->delete();

            for ($i = 0; $i < $countClasses; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
            $notification = array(
                'message' => 'Fee Amount Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('fee.amount.view')->with($notification);
        }
    }

    public function detail($fee_category_id)
    {
        $detail = FeeAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.detail_amount', compact('detail'));
    }
}
