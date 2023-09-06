<?php

namespace App\Http\Controllers\backend\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;


class ClientAuthController extends Controller
{
    public function view_login()
    {
        return view('backend.client.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        $check = Auth::guard('client')->attempt($credentials);

        if($check)
        {
            $email = DB::table('Clients')
            ->where('email',$request->email)
            ->where('verified','1')->first();

            if($email)
            {
                return redirect()->route('view.client-dashboard');
            }
            else
            {
                session()->flash('error','Email not verified!');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error','Invalid credentials!');
            return redirect()->back();
        }
    }

    public function view_dashboard()
    {
        return view('backend.client.dashboard');
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect()->route('view.client-login');
    }


}
