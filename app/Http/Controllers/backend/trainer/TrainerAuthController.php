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

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $check = Auth::guard('trainer')->attempt($credentials);

        if($check)
        {
            return view('backend.trainer.dashboard');
        }
        else
        {
            echo "Invalid";
        }
       
    }

}
