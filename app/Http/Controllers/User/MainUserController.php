<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MainUserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.profile.view_profile', compact('user'));
    }

    public function UserProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('user.profile.view_profile_edit', compact('editData'));
    }

    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);

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
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('user.profile')->with($notification);
    }

    public function UserPasswordView()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('user.password.edit_password', compact('editData'));
    }

    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hassedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hassedPassword))
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }

    }
}
