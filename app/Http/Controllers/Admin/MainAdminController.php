<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Auth;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MainAdminController extends Controller
{
    public function AdminProfile()
    {
        $id = Auth::guard('admin')->user()->id;
        $adminData = Admin::find($id);

        return view('admin.profile.view_profile', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $id = Auth::guard('admin')->user()->id;
        $editData = Admin::find($id);

        return view('admin.profile.view_profile_edit', compact('editData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(Auth::guard('admin')->user()->id);

        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            Storage::delete($data->profile_photo_path);
            $filename = date('YmdHi').'.'.$file->extension();

            $path = Storage::putFileAs('public/profile-photos', new File($file), $filename);
//            $file->move(public_path('uploads/user_image'),$filename);
            $data['profile_photo_path'] = $path;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminPasswordView()
    {
        $id = Auth::guard('admin')->user()->id;
        $editData = Admin::find($id);
        return view('admin.password.edit_password', compact('editData'));
    }

    public function AdminPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hassedPassword = Auth::guard('admin')->user()->password;
        if(Hash::check($request->oldpassword, $hassedPassword))
        {
            $user = Admin::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        } else {
            return redirect()->back();
        }

    }
}
