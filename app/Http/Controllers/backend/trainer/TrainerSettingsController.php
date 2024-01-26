<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainers;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Validation\Rule;
use Hash;

class TrainerSettingsController extends Controller
{
    public function my_profile()
    {
        $trainer_id = Auth::guard('trainer')->user()->id;

        $trainer = Trainers::find($trainer_id);

        

          
        if($trainer)
        {
            return view('backend.trainer.myprofile',compact('trainer'));
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
            $trainer = Trainers::find($request->trainer_id);
            if (Hash::check($request->currentpassword, $trainer->password)) 
            {
              
                $newpass = Hash::make($request->password);
                $trainer->password = $newpass;
        
                if ($trainer->save()) 
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

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'           =>'required',
            'contact' => [
                'required',
                Rule::unique('trainers', 'contact')->ignore($request->trainer_id),
            ],
            'address'        =>'required',
            'body_weight'    =>'required',
            'height'         =>'required',
           
        ], [
            'contact.unique' => 'The contact is already in use',
            
        ]);

        if($validate->passes())
        {
            $trainer = Trainers::find($request->trainer_id);
            $trainer->name        = $request->name;
            $trainer->contact     = $request->contact;
            $trainer->address     = $request->address;
            $trainer->body_weight = $request->body_weight;
            $trainer->height      = $request->height;


            if($request->hasFile('picture'))
            {
                $ext                  = $document->getClientOriginalExtension();
                echo $ext;die;
                $DocumentOriginalName =  time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                $document->move(public_path('/images/TrainerDocuments/'), $DocumentOriginalName);
                $trainer->picture =  $DocumentOriginalName;
            }

            if($trainer->save())
            {
                session()->flash('success','Profile Updated!');
                return redirect()->back();
            }
            else
            {
                session()->flash('error','Error!');
                return redirect()->back();
            }
            
        }
        else
        {
            return redirect()->back()->withErrors($validate);
        }
    }
}
