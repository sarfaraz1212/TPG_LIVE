<?php

namespace App\Http\Controllers\backend\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainers;
use App\Models\verificationstoken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
class AdminTrainerController extends Controller
{
    public function view_add_trainer()
    {
        return view('backend.admin.trainer.add');
    }

    public function add_trainer(Request $request)
    { 
        
        $validate = Validator::make($request->all(),[
            'name'              => 'required|alpha',
            'email'             => 'required|email:rfc,dns|unique:trainers,email',
            'password'          => 'required',
            'cpassword'         => 'required|same:password',
            'startdate'         => 'required',
            'salary'            => 'required|numeric',
            'bodyweight'        => 'required',
            'height'            => 'required',
            'tnum'              => 'required|numeric|unique:trainers,trainer_number',
            'picture'           => 'required|array',
            'picture.*'         => 'image|mimes:jpeg,png,jpg',
            'documents'         => 'required|array',
            'documents.*'       => 'mimes:pdf',
            'certifications'    => 'required|array',
            'certifications.*'  => 'mimes:pdf',          
            'address'           => 'required',
            'skills'            => 'required',
            'contact'           => 'required|unique:trainers,contact',
            'program'           => 'required',
            'mode'              => 'required',
            'gender'            => 'required',
        ],
        [

            'cpassword.required' => 'Confirm Password is required',
            'cpassword.same'     => "Passwords Don't match",
            
            'tnum.required'      => 'Trainer number is required',
            'tnum.unique'        => 'Trainer number is already taken',

            'contact.unique'     => 'This contact number is already taken',
            

        ]);
       

        if($validate->passes())
        { 
            
        
            $check = Trainers::where('email', $request->email)->orWhere('trainer_number', $request->tnum)->first();
         
          

            if(!$check)
            {
                $trainer = new Trainers();
                $trainer->trainer_number    = $request->tnum;
                $trainer->name              = $request->name;
                $trainer->email             = $request->email;
                $trainer->dob               = $request->dob;
                $trainer->password          = Hash::make($request->password);
                $trainer->contact           = $request->contact;
                $trainer->address           = $request->address;
                $trainer->body_weight       = $request->bodyweight;
                $trainer->height            = $request->height;
                $trainer->mode              = implode(',', $request->mode); 
                $trainer->gender            = $request->gender;
                $trainer->start_date        = $request->startdate;
                $trainer->salary            = $request->salary;
                $trainer->medical_condition = $request->medical_condition;
                $trainer->programs          = implode(',', $request->program); 
                $trainer->skills            = implode(',', $request->skills); 

                //=============================Image Handle=============================== 

                
                $images       = [];
                $documents    = [];
                $certificates = [];
                foreach($request->file('picture') as $pic)
                { 
                    $ext = $pic->getClientOriginalExtension();
                    $ProfileOriginalName = time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $pic->move(public_path('/images/TrainerImage/'), $ProfileOriginalName);
                    $images[] = $ProfileOriginalName;
                
                }
            
            
        
                foreach($request->file('documents') as $document)
                { 
                    $ext = $document->getClientOriginalExtension();
                    $DocumentOriginalName =  time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $document->move(public_path('/images/TrainerDocuments/'), $DocumentOriginalName);
                    $documents[] = $DocumentOriginalName;

                
                }
        
                
                foreach($request->file('certifications') as $certificate)
                { 
                    $ext = $certificate->getClientOriginalExtension();
                    $CertificatesOriginalName =  time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $certificate->move(public_path('/images/TrainerCertifications/'), $CertificatesOriginalName);
                    $certificates[] = $CertificatesOriginalName;
                }
        
                $trainerImages       = implode(',', $images);
                $trainerDocuments    = implode(',', $documents);
                $trainerCertificates = implode(',', $certificates);

          
            
                $trainer->picture        =    $trainerImages ;
                $trainer->certifications =    $trainerCertificates;
                $trainer->documents      =    $trainerDocuments;

                //===========================================================================

                if($trainer->save())
                {
                    $token      = str::random(10);
                    $name       = $request->name;
                    $expiration = Carbon::now()->addMinutes(5);
                    
                    $verification             =  new verificationstoken();
                    $verification->email      = $request->email;;
                    $verification->token      = $token;
                    $verification->expires_at = $expiration;
                    $verification->created_at = Carbon::now();
                    if($verification->save())
                    {
                        Mail::send(['html' => 'emails.email'], ["token" => $token,"name"=>$name,"email" => $request->email], function ($message) use ($request) {
                            $message->to($request->email);
                            $message->subject("Email Verification");
                        });

                        session()->flash('success', 'Trainer Added Successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        echo "error";
                    }
                }
                else
                {
                    echo "error";
                }
            }
            else
            {
                session()->flash('error','A user with these credentials already exists');
                return redirect()->back();
            }

            
        }

        else
        {
          
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    public function trainer_verify_email($token)
    {
        
        $get_email      = DB::table('verifications_tokens')->where('token',$token)->first();
     
        if($get_email)
        {
            $expirationTime = Carbon::parse($get_email->expires_at);
            $now            = Carbon::now();
            $email = $get_email -> email;

            if ($now->greaterThan($expirationTime)) 
            {
                DB::table('verifications_tokens')->where('token', $token)->delete();
                return view('backend.admin.trainer.errors.tokenerror');
            }
            else
            {   
                $UpdateStatus = DB::table('trainers')->where('email', $email)->update(['verified' => '1']);
                if($UpdateStatus)
                {
                    $dlt = DB::table('verifications_tokens')->where('email',$email)->delete();
                    
                }
                else
                {
                    echo "false";
                }    
            }
        }
        else
        {
            return view('backend.admin.trainer.errors.tokenerror');
        }
    }

    public function re_trainer_verify_email(Request $request)
    {
     
        $check = DB::table('verifications_tokens')->where('email', $request->email)->first();
        $token = Str::random(10);
        $expiration = Carbon::now()->addMinutes(5);

        if (!$check) {
            // Create a new verification token if it doesn't exist
            $verification = new VerificationsToken();
            $verification->email = $request->email;
            $verification->token = $token;
            $verification->expires_at = $expiration;
            $verification->created_at = Carbon::now();
        } else {
            // Update the existing verification token
            $verification =  VerificationsToken::find($request->email);
            $verification->token = $token;
            $verification->expires_at = $expiration;
            $verification->updated_at = Carbon::now();
        }

        if ($verification->save()) {
            Mail::send(['html' => 'emails.email'], ["token" => $token,"name" =>$request->name,"email" =>$request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Email Verification");
            });

            session()->flash('success', 'Verification email sent!');
            return redirect()->back();
        } else {
            echo "error";
        }
    }


    public function view_trainers_list()
    {
        $Vtrainers = DB::table('trainers')->where('verified', '1')->whereNull('deleted_at')->get();
        return view('backend.admin.trainer.list',['Vtrainers'=> $Vtrainers]);
    }

    public function view_non_verfified_trainers()
    {
      
    
        $trainers =DB::table('trainers')->where('verified','0')->get();
        return view('backend.admin.trainer.Nlist',['trainers'=> $trainers]);
    }

    public function view_edit_trainer($id)
    {
        $trainer = Trainers::find($id);

        $programArray = explode(',', $trainer->programs);
        $goalArray = explode(',',$trainer->skills);
        $modeArray = explode(',',$trainer->mode);
     

        return view('backend.admin.trainer.edit',['trainer' => $trainer,'goalArray' => $goalArray,'programArray'=> $programArray,'modeArray'=>$modeArray]);
    }

    public function edit_trainer(Request $request,$id)
    {
        $edit_trainer = Trainers::find($id);
        
       
        $validate = Validator::make($request->all(),[
            'name'              => 'required|alpha',
            'startdate'         => 'required',
            'salary'            => 'required|numeric',
            'bodyweight'        => 'required',
            'height'            => 'required',
            'tnum' => [
                'required',
                Rule::unique('trainers', 'trainer_number')->ignore($edit_trainer->id),
                'numeric',
            ],
            'picture.*'         => 'nullable|image|mimes:jpeg,png,jpg',
            'documents.*'       => 'nullable|mimes:pdf',
            'certifications.*'  => 'nullable|mimes:pdf',
            'address'           => 'required',
            'skills'            => 'required',
            'contact' => [
                'required',
                Rule::unique('trainers', 'contact')->ignore($edit_trainer->id),
            ],
            'programs'           => 'required',
            'mode'              => 'required',
            'gender'            => 'required',
        ],
        [
            'tnum.required'      => 'Trainer number is required',
            'tnum.unique'        => 'Trainer number is already taken',

            'contact.unique'     => 'This contact number is already taken',
            

        ]);

        if($validate->passes())
        {
          

            $edit_trainer->trainer_number    = $request->tnum;
            $edit_trainer->name              = $request->name;
            $edit_trainer->email             = $request->email;
            $edit_trainer->dob               = $request->dob;
            $edit_trainer->contact           = $request->contact;
            $edit_trainer->address           = $request->address;
            $edit_trainer->body_weight       = $request->bodyweight;
            $edit_trainer->height            = $request->height;
            $edit_trainer->mode              = implode(',', $request->mode); 
            $edit_trainer->gender            = $request->gender;
            $edit_trainer->start_date        = $request->startdate;
            $edit_trainer->salary            = $request->salary;

            if($request->medical_condition)
            {
                $edit_trainer->medical_condition = $request->medical_condition;
            }
        
            $edit_trainer->programs          = implode(',', $request->programs); 
            $edit_trainer->skills            = implode(',', $request->skills); 

            //=============================Image Handle=============================== 

            //get the previous images because if we add new image array old images will get deleted
            $old_images         = $edit_trainer->picture;
            $old_documents      = $edit_trainer->documents;
            $old_certifications = $edit_trainer->certifications;
     
                
            $images       = [];
            $documents    = [];
            $certificates = [];

            if($request->picture)
            {
                foreach($request->file('picture') as $pic)
                { 
                    $ext = $pic->getClientOriginalExtension();
                    $ProfileOriginalName = time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $pic->move(public_path('/images/TrainerImage/'), $ProfileOriginalName);
                    $images[] = $ProfileOriginalName;
                
                }
                  $trainerImages = implode(',', $images);
                
                  //if old images is empty then a extra , is coming 
                  if(empty($old_images))
                  {
                    $images_final = $trainerImages;
                  }
                  else 
                  {
                    $images_final = $old_images.','.$trainerImages;
                  }
                  $edit_trainer->picture        = $images_final;
        
            }

            if($request->documents)
            {
                foreach($request->file('documents') as $document)
                { 
                    $ext = $document->getClientOriginalExtension();
                    $DocumentOriginalName =  time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $document->move(public_path('/images/TrainerDocuments/'), $DocumentOriginalName);
                    $documents[] = $DocumentOriginalName;
                }
                $trainerDocuments    = implode(',', $documents);

                if(empty($old_documents))
                  {
                    $documents_final = $trainerDocuments;
                  }
                  else 
                  {
                    $documents_final    = $old_documents.','.$trainerDocuments;
                  }
                $edit_trainer->documents      = $documents_final;
            }

            if($request->certifications)
            {
                foreach($request->file('certifications') as $certificate)
                { 
                    $ext = $certificate->getClientOriginalExtension();
                    $CertificatesOriginalName =  time() . '_' . mt_rand(1, 9999) . '.' . $ext;
                    $certificate->move(public_path('/images/TrainerCertifications/'), $CertificatesOriginalName);
                    $certificates[] = $CertificatesOriginalName;
                }
                $trainerCertificates = implode(',', $certificates);
              

                
                if(empty($old_documents))
                {
                  $certificate_final = $trainerCertificates;
                }
                else 
                {
                    $certificate_final  = $old_certifications.','.$trainerCertificates;
                }
          
                $edit_trainer->certifications = $certificate_final;
            }
            
            if($edit_trainer->save())
            {
                session()->flash('success','Trainer Edited Successfully!');
                return redirect()->back();
            }
            else
            {
                session()->flash('error','Please try again later!');
            }
        }

        else
        {
            return redirect()->back()->withErrors($validate);
        }
       
      
    }

    public function delete_trainer($id)
    {
        $dltrainer = Trainers::find($id);

        $dltrainer->deleted_at = Carbon::now();
        
        if($dltrainer->save())
        {
            session()->flash('success','Trainer Deleted Successfully!');
            return redirect()->back();
        }
        else
        {
            session()->flash('error','Error! Try again later');
            return redirect()->back();
        }
    }

    public function delete_image(Request $request)
    {  
        $id                  = $request->id;
        $image_to_be_deleted = $request->imageName;
        $trainer = Trainers::find($id);

        //pictures currenlty stored in database
        $oldpictures_string = $trainer->picture;
        
        //Convert it into array
        $old_pictures = explode(',',$oldpictures_string);

        //index of the image to be deleted
        $index = array_search($image_to_be_deleted, $old_pictures);

        if($index !== FALSE)
        {
            array_splice($old_pictures,$index,1);
            
            $updated_pictures = implode(',',$old_pictures);
            $trainer->picture = $updated_pictures;

            if($trainer->save())
            {
                echo "done";
            }
            else
            {
                echo "Error";
            }

        }
       
    }

    public function delete_document(Request $request)
    {
    
       $document_to_be_deleted = $request->docname;
       $id                     = $request->id;

       $trainer = Trainers::find($id);

       $old_documents_string = $trainer->documents;
       $old_documents        = explode(',',$old_documents_string);
       
       $index = array_search($document_to_be_deleted,$old_documents);

       if($index !== false)
       {
            array_splice($old_documents,$index,1);
            $updated_documents = implode(',',$old_documents);

            $trainer->documents = $updated_documents;

            if($trainer->save())
            {
                echo "saved";
            }
            else
            {
                echo "Error";
            }
        }
    }

    public function delete_certificate(Request $request)
    {
      

        $certificate_to_be_deleted = $request->certificate_name;
        $id                     = $request->id;
 
        $trainer = Trainers::find($id);
 
        $old_certificate_string = $trainer->certifications;
        $old_certificate        = explode(',',$old_certificate_string);

        $index = array_search($certificate_to_be_deleted,$old_certificate);

       if($index !== false)
       {
            array_splice($old_certificate,$index,1);
            $updated_certificates = implode(',',$old_certificate);
          

            $trainer->certifications = $updated_certificates;

            if($trainer->save())
            {
                echo "saved";
            }
            else
            {
                echo "Error";
            }
        }
        
    }


}
