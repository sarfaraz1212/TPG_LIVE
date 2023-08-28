<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AdminAuthController extends Controller
{
    public function viewlogin()
    {
        return view('backend.admin.login');
    }

    public function viewregister()
    {
        return view('backend.admin.register');
    }

    public function register(Request $request)
    {
        $admin = new Admin();

        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back();
    }

    public function login(Request $request)
    {
        
        $credentials = $request->only(['email','password']);
        $check = Auth::guard('admin')->attempt($credentials);

        if($check)
        {
            return redirect()->route('view.dashboard');
        }
        else
        {
            echo "Err";
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('view.login');
    }
}
