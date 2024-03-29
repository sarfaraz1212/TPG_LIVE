<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Auth;

class TrainerAuthController extends Controller
{
    public function view_login()
    {
        return view('backend.trainer.login');
    }

    public function view_dashboard()
    {
        return view('backend.trainer.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $check = Auth::guard('trainer')->attempt($credentials);

        if($check)
        {
            return redirect()->route('view.trainer-dashboard');
        }
        else
        {
            echo "Invalid";
        }
       
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect()->route('view.trainer-login');
    }

}
