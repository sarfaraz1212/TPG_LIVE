<?php

namespace App\Http\Controllers\backend\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Hash;
use DB;
use Auth;


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
           
            $email = DB::table('clients')
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
        Auth::guard('client')->logout();
        return redirect()->route('view.client-login');
    }

    public function send_link(Request $request)
    {
        $email      = $request->email;
        $expiration = Carbon::now()->addMinutes(60);
        $check      = Clients::where('email', $email)->exists();

        if ($check) 
        {
        $token = Str::random(10);
        $check_email = DB::table('password_reset_tokens')->where('email',$email)->exists();

        if($check_email)
        { 
                $update_token = DB::table('password_reset_tokens')->where('email',$email)->update([
                    'token'      => $token,
                    'expires_at' => $expiration,
                ]);
                
                if($update_token)
                {
                    Mail::send(['html' => 'emails.client-forgot-password'], ["token" => $token], function ($message) use ($request) {
                        $message->to($request->email);
                        $message->subject("Reset Password");
                    });   

                    return response()->json(['status' => 'success', 'message' => 'Password reset email sent!']);
                }
        }
        else
        {
                $create_token = DB::table('password_reset_tokens')->insert([
                    'email'      => $email,
                    'token'      => $token,
                    'expires_at' => $expiration,
                    'created_at' => Carbon::now()
                ]);

                if($create_token)
                {
                    Mail::send(['html' => 'emails.client-forgot-password'], ["token" => $token], function ($message) use ($request) {
                        $message->to($request->email);
                        $message->subject("Reset Password");
                    });    

                    return response()->json(['status' => 'success', 'message' => 'Password reset email sent!']);
                }
        }
        } 
        else 
        {
            return response()->json(['status' => 'error', 'message' => 'No User found with this Email!']);
        }
    }

    public function view_reset_password($token)
    {
        $check_token = DB::table('password_reset_tokens')->where('token',$token)->exists();
        if($check_token)
        {
            $expirationTime = DB::table('password_reset_tokens')->where('token', $token)->value('expires_at');
    
            $now = Carbon::now();
        
            if ($now->greaterThan($expirationTime)) 
            {
                DB::table('password_reset_tokens')->where('token', $token)->delete();
                session()->flash('error','Token Invalid or expired, Please try again');
                return redirect()->route('view.client-login');
            }
            else
            {
                return view('backend.client.password-reset', compact('token'));
            }
        }
        else
        {
            session()->flash('error','Token Invalid or expired, Please try again');
            return redirect()->route('view.client-login');
        }
    }

    public function reset_password(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'password'  => 'required',
            'cpassword' => 'required|same:password', 
           ],
           [
            'cpassword.same'     =>"Passwords Don't match",
            'cpassword.required' =>"Confirm password is required", 
           ]);
    
           if($validate->passes())
           {
             $check_token = DB::table('password_reset_tokens')->where('token',$request->token)->first();
             if($check_token)
             {
                $client = Clients::where('email',$check_token->email)->first();
                $client->password = Hash::make($request->password);

                if($client->save())
                {
                    session()->flash('success','Password Updated!');
                    return redirect()->route('view.client-login');
                }
             }
           }
    
           else
           {
            return redirect()->back()->withErrors($validate)->withInput();
           }
    }


}
