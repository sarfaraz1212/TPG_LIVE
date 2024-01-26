<?php

namespace App\Http\Controllers\backend\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Validation\Rule;
use Hash;


class ClientSettingsController extends Controller
{
    public function view()
    {
        $client_id = Auth::guard('client')->id();

        $client = Clients::find($client_id);

        return view('backend.client.settings.view',compact('client'));
    }

    public function update(Request $request)
    {
       

        $validate = Validator::make($request->all(), [
            'name'           =>'required',
            'contact'        => [
                                    'required',
                                    Rule::unique('clients', 'contact')->ignore($request->client_id),
                                ],
            'address'        =>'required',
            'bodyweight'     =>'required',
            'height'         =>'required',
           
        ], [
            'contact.unique' => 'The contact is already in use',
            
        ]);

        if($validate->passes())
        {
            $client = Clients::find($request->client_id);

            $client->name       = $request->name;
            $client->contact    = $request->contact;
            $client->address    = $request->address;
            $client->bodyweight = $request->bodyweight;
            $client->height     = $request->height;

            if($request->profile)
            {
                $file            = $request->profile;
                $ext             =  $file->getClientOriginalExtension();
                $Name            = time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                $file->move(public_path('/images/ClientImages/'), $Name);
                $client->profile = $Name;
                
            }

            if($client->save())
            {
                session()->flash('success','Profile Updated Successfully!');
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back()->withErrors($validate);
        }
    }

    public function reset_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'currentpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required' => 'New password is required',
            'password.confirmed' => 'Passwords do not match', 
            'currentpassword.required' => 'Current password is required',
            'cpassword.required' => 'Confirm password is required',
        ]);
        
        
        if ($validate->passes()) 
        {
            $client = Clients::find($request->client_id);
            if (Hash::check($request->currentpassword, $client->password)) 
            {
              
                $newpass = Hash::make($request->password);
                $client->password = $newpass;
        
                if ($client->save()) 
                {
                    session()->flash('success', 'Password updated!');
                    return redirect()->back();
                }
            } 
            else 
            {
                session()->flash('error', 'Current password is incorrect.');
                return redirect()->back();
            }
        } 
        else 
        {
            return redirect()->back()->withErrors($validate);
        }    
    }
}
