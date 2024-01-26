<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Packages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\verificationstoken;
use Auth;
use Hash;

class AdminClientsController extends Controller
{
    public function view_add_client()
    {
        $trainers = DB::table('trainers')->where('verified','1')->whereNull('deleted_at')->get(); 
        $packages = Packages::all(); 

        return view('backend.admin.client.add',['trainers'=>$trainers,'packages'=> $packages]);
    }
    
    public function add_client(Request $request)
    {
        
        $validate = Validator::make($request->all(), 
        [
            'name'              => 'required|regex:/^[a-zA-Z\s]+$/',
            'email'             => 'required|email|unique:clients,email',
            'password'          => 'required',
            'cpassword'         => 'required|same:password',
            'package'           => 'required|numeric',
            'fee'               => 'required|numeric',
            'address'           => 'required',
            'startdate'         => 'date',
            'enddate'           => 'date|after:startdate',
            'bodyweight'        => 'required',
            'height'            => 'required',
            'medical_condition' => 'nullable|regex:/^[a-zA-Z\s]+$/',
            'contact'           => 'required|numeric',
            'assigned_trainer'  => 'required|numeric',
            'goal'              => 'required',
            'gender'            => 'required',
        ],
        [
            'cpassword.required'         => "The confirm password field is required",
            'cpassword.same'             => "Passwords don't match!",
            'startdate.required'         => 'Start date is required',
            'enddate.required'           => 'End date is required',
        ]
    ); 

        if($validate->passes())
        {
            $clients =  new Clients();

            $clients->name             = $request->name;
            $clients->email            = $request->email;
            $clients->password         = Hash::make($request->password);
            $clients->fee              = $request->fee;
            $clients->package          = $request->package;
            $clients->goals            = implode(',',$request->goal);
            $clients->gender           = $request->gender;
            $clients->startdate        = $request->startdate;
            $clients->enddate          = $request->enddate;
            $clients->bodyweight       = $request->bodyweight;
            $clients->height           = $request->height;
            $clients->address          = $request->address;
            $clients->contact          = $request->contact;
            $clients->assigned_trainer = $request->assigned_trainer;

                
            $token      = str::random(10);
            $email      = $request->email;
            $name       = $request->name;
            $expiration = Carbon::now()->addMinutes(5);
                    
            $verification             =  new verificationstoken();
            $verification->email      = $request->email;;
            $verification->token      = $token;
            $verification->expires_at = $expiration;
            $verification->created_at = Carbon::now();
            $verification->save();

            $check = Mail::send(['html' => 'emails.WelcomeClient'], ["token" => $token,"name" => $name], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Welcome to the Family!");
            });

            if($check)
            {
                $clients->save();
                session()->flash('success','Client Added!');
                return redirect()->back();
            }

            else
            {
                session()->flash('Error','Failed!');
            }

        }
        else
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
      
    }

    public function client_verify_email($token)
    {
        if($token)
        {
            $verify = DB::table('verifications_tokens')->where('token',$token)->first();
           
            $now    = Carbon::now();

            if($verify)
            {
               $email  = $verify->email;
               $expiration_time = $verify->expires_at;

               if($now->greaterThan($expiration_time))
               {
                DB::table('verifications_tokens')->where('token', $token)->delete();
                return view('backend.admin.trainer.errors.tokenerror');
               }

               else
               {
                    $UpdateStatus = DB::table('clients')->where('email', $email)->update(['verified' => '1']);
                    if($UpdateStatus)
                    {
                        $dlt = DB::table('verifications_tokens')->where('email',$email)->delete();
                        
                    }
                    else
                    {
                        return view('backend.admin.trainer.errors.tokenerror');
                    }    
               }
            }
            else
            {
                 return view('backend.admin.trainer.errors.tokenerror');
            }
        }
    }

    public function view_clients()
    {
        $Vclients =  DB::table('clients')->where('verified','1')->get();
        return view('backend.admin.client.list',['Vclients'=>$Vclients]);
    }

    public function view_non_verfified_clients()
    {
        $clients  =  DB::table('clients')->where('verified','0')->get();
        return view('backend.admin.client.Nlist',['clients'=>$clients]);
    }

    public function view_edit_client($id)
    {
        $client   = Clients::find($id);
        $packages = Packages::all(); 
        $trainers = DB::table('trainers')->where('verified','1')->whereNull('deleted_at')->get(); 

        if($client)
        {
            return view('backend.admin.client.edit',['client' => $client,'packages'=> $packages,'trainers'=>$trainers]);
        }
        else
        {
            echo "Not found";
        }
       
    }

    public function edit_client(Request $request,$id)
    {
        $client = Clients::find($id);
        $validate = Validator::make($request->all(), 
            [
                'name'              => 'required|regex:/^[a-zA-Z\s]+$/',
                'email'             => ['required',
                                        Rule::unique('clients', 'email')->ignore($client->id),
                                        ],
                'package'           => 'required|numeric',
                'fee'               => 'required|numeric',
                'startdate'         => 'date',
                'enddate'           => 'date|after:startdate',
                'bodyweight'        => 'required',
                'height'            => 'required',
                'address'           => 'required',
                'medical_condition' => 'nullable|regex:/^[a-zA-Z\s]+$/',
                'contact'           => ['required', 
                                        Rule::unique('clients', 'contact')->ignore($client->id),
                                        'numeric'],
                'assigned_trainer'  => 'required|numeric',
                'goal'              => 'required',
                'gender'            => 'required',
            ],
            [
                'startdate.required'         => 'Start date is required',
                'enddate.required'           => 'End date is required',
            ]
        ); 

        if($validate->passes())
        {
            $client->name             = $request->name;
            $client->email            = $request->email;
            $client->fee              = $request->fee;
            $client->package          = $request->package;
            $client->goals            = implode(',',$request->goal);
            $client->gender           = $request->gender;
            $client->startdate        = $request->startdate;
            $client->enddate          = $request->enddate;
            $client->bodyweight       = $request->bodyweight;
            $client->height           = $request->height;
            $client->contact          = $request->contact;
            $client->assigned_trainer = $request->assigned_trainer;
            $client->address          = $request->address;

           if( $client->save())
           {
            session()->flash('success','Client Editied Successfully!');
            return redirect()->back();
           }

        }

        else
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    public function re_verify_client(Request $request)
    {
        $token = Str::random(10);
        $expiration = Carbon::now()->addMinutes(5);
        $email = $request->email;
        $name = $request->name;
    
        $verification = DB::table('verifications_tokens')->where('email', $email)->first();
    
        if (!$verification) {
            $verification             =  new verificationstoken();
            $verification->email      = $request->email;;
            $verification->token      = $token;
            $verification->expires_at = $expiration;
            $verification->created_at = Carbon::now();

            $verification->save();
        } else {
            DB::table('verifications_tokens')->where('email', $email)->update(['token' => $token, 'expires_at' => $expiration]);
        }
    
        $mailSent = Mail::send(['html' => 'emails.WelcomeClient'], ["token" => $token, "name" => $name], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Welcome to the Family!");
        });
    
        if ($mailSent) 
        {
            session()->flash('success', 'Email sent!');
        }
        else
        {
            session()->flash('error', 'Error!');
        }
    
        return redirect()->back();
    }
    
}
