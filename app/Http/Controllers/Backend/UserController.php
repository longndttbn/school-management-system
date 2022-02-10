<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function add()
    {
        # code...
        return view('backend.user.add_user');
    }

    public function view()
    {
        $allData = User::all();
        // compact chinh la data['allData']
        return view('backend.user.view_user', compact('allData'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data = new User();
        $data->type = $request->type;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);

        $data->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->type = $request->type;
        $data->name = $request->name;
        $data->email = $request->email;

        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function delete($id)
    {
        $user = User::find($id)->delete();
        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('user.view')->with($notification);
    }
}
