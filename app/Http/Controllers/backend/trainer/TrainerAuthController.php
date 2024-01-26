<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Trainers;
use Illuminate\Support\Facades\Validator;
use Hash;

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
            session()->flash('error', 'Invalid Credentials');
            return redirect()->back()->withInput();            
        }
       
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect()->route('view.trainer-login');
    }

    public function send_link(Request $request)
    {
        $email      = $request->email;
        $expiration = Carbon::now()->addMinutes(60);
        $check      = Trainers::where('email', $email)->exists();

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
                    Mail::send(['html' => 'emails.forgot-password'], ["token" => $token], function ($message) use ($request) {
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
                    Mail::send(['html' => 'emails.forgot-password'], ["token" => $token], function ($message) use ($request) {
                        $message->to($request->email);
                        $message->subject("Reset Password");
                    });    

                    return response()->json(['status' => 'success', 'message' => 'Password reset email sent!']);
                }
        }
        } 
        else 
        {
            return response()->json(['status' => 'error', 'message' => 'No trainer found with this Email!']);
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
                return redirect()->route('view.trainer-login');
            }
            else
            {
                return view('backend.trainer.password-reset', compact('token'));
            }
        }
        else
        {
            session()->flash('error','Token Invalid or expired, Please try again');
            return redirect()->route('view.trainer-login');
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
            $trainer = Trainers::where('email',$check_token->email)->first();
            $trainer->password = Hash::make($request->password);

            if($trainer->save())
            {
                session()->flash('success','Password Updated!');
                return redirect()->route('view.trainer-login');
            }
         }
       }

       else
       {
        return redirect()->back()->withErrors($validate)->withInput();
       }
    }

    
}
