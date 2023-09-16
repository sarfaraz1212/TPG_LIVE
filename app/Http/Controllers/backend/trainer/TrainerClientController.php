<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Trainers;
use App\Models\Diets;
use App\Models\Workout;
use Auth;
use DB;
use GuzzleHttp\Client;
class TrainerClientController extends Controller
{

    public function view_dashboard()
    {
        return view('backend.trainer.dashboard');
    }

    public function my_clients()
    {
        $current_trainer = Auth::guard('trainer')->user()->id;

        if($current_trainer)
        {
            $clients = DB::table('clients')
            ->select('id','name')
            ->where('assigned_trainer', $current_trainer)
            ->where('verified', 1)
            ->where('status', 1)
            ->get();

            if(count($clients) > 0)
            {
                return view('backend.trainer.clients.myclients',['clients' => $clients]);
            } 
        }      
    }

    public function get_client($id)
    {
        $trainer_id = Auth::guard('trainer')->user()->id;
        $client = Clients::where('id', $id)->where('assigned_trainer', $trainer_id)->first();

        return view('backend.trainer.clients.client', ['client' => $client]);

       
    }

    public function add_diet($id)
    {
     
      $client = Clients::select('name', 'medical_condition','id')->find($id);
      if($client)
      {
        return view('backend.trainer.clients.add-diet',['client'=>$client]);
      }
      else
      {
        echo "Error";
      }
      
    }

    public function get_calories(Request $request)
    {
        $meal = $request->meal;
        $apiKey = '7tElYaTYpDN2mr2d7GFaBA==RexK9tUvFbcxCqqt';

        // Create a Guzzle client instance

        $client = new Client();

        // Define the API endpoint URL
        $url = "https://api.api-ninjas.com/v1/nutrition?query={$meal}";

        try {
            // Make the API request with the API key in the headers
            $response = $client->request('GET', $url, [
                'headers' => [
                    'X-Api-Key' => $apiKey,
                ],
            ]);

            // Get the API response as JSON
            $data = json_decode($response->getBody(), true);

            // Handle the API response data
            return response()->json($data);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function save_diet( Request $request )
    {
      
        $trainer_id = Auth::guard('trainer')->user()->id;

        $check = DB::table('diets')->where('client_id',$request->client_id)->first();

        if(!$check)
        {
            $add_diet = new Diets();
            $add_diet->client_id  = $request->client_id;
            $add_diet->trainer_id  = $trainer_id;
            
            $add_diet->meals    = implode(',',$request->input('meal'));
            $add_diet->protein  = implode(',',$request->input('protein'));
            $add_diet->carbs    = implode(',',$request->input('carbs'));
            $add_diet->fats     = implode(',',$request->input('fats'));
            $add_diet->calories     = implode(',',$request->input('calories'));

            $add_diet->total_protein = $request->total_protein;
            $add_diet->total_carbs = $request->total_carbs;
            $add_diet->total_fats = $request->total_fats;
            $add_diet->total_calories = $request->total_calories;

            if($add_diet->save())
            {
                session()->flash('success','Diet Added!');
                session()->put('diet_set','1');
                return redirect()->route('view.client',['id' => $request->client_id]);
            }
            else
            {
                session()->flash('error','Error! Please try again later');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error','Diet for this client already exists');
            return redirect()->back();
        }

        
    }

    public function view_edit_diet($id)
    {

       $client_id = $id;

       if($client_id)
       {
            $diets =  Diets::where('client_id', $id)->get();
            $diet = Diets::where('client_id', $id)->first();
            if($diet)
            {
                $diet_id = $diet->id;
                $trainer_id = $diet->trainer_id;
        
                $current_trainer_id = Auth::guard('trainer')->user()->id;
        
                if($trainer_id == $current_trainer_id)
                {
                    return view('backend.trainer.clients.edit-diet', compact('diets', 'client_id','diet_id'));
                }
        
                else
                {
                echo "Error";
                }
            }
            else
            {
                echo "Error";
            }    
       }
    }
    
    public function edit_diet( Request $request,$id )
    {

        $add_diet =  Diets::find($id);
        $trainer_id = Auth::guard('trainer')->user()->id;

        
        $add_diet->meals    = implode(',',$request->input('meal'));
        $add_diet->protein  = implode(',',$request->input('protein'));
        $add_diet->carbs    = implode(',',$request->input('carbs'));
        $add_diet->fats     = implode(',',$request->input('fats'));
        $add_diet->calories     = implode(',',$request->input('calories'));

        $add_diet->total_protein = $request->total_protein;
        $add_diet->total_carbs = $request->total_carbs;
        $add_diet->total_fats = $request->total_fats;
        $add_diet->total_calories = $request->total_calories;

        if($add_diet->save())
        {
            session()->flash('success','Diet Edited!');
            return redirect()->back();
        }
        else
        {
            session()->flash('error','Error! Please try again later');
            return redirect()->back();
        }
    }

    public function delete_diet($id)
    {
        $diet      = Diets::find($id);
        $client_id = $diet->client_id;

        if($diet)
        {
            if($diet->delete())
            {
                session()->flash('success','Diet Deleted!');
                session()->forget('diet_set');
                return redirect()->route('view.client',['id' => $client_id]);
            }

            session()->flash('success','Diet Deleted!');
            return redirect()->route('view.client',['id' => $client_id]);
           
        }
        else
        {
            session()->flash('success','Diet Deleted!');
            return redirect()->route('view.client',['id' => $client_id]);
        }
    }


    public function make_workout($id)
    {
        $trainer_id = Auth::guard('trainer')->user()->id;

        $client = Clients::select('id')->where('id', $id)->where('assigned_trainer',$trainer_id)->first();

        if ($client) {
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday'];
            return view('backend.trainer.clients.add-workout', compact('client', 'daysOfWeek'));
        }
        
        else
        {
            echo "Error";
        }
    }

    public function add_workout(Request $request,$id)
    {
        
        $check = Workout::where('client_id',$id)->first();

        if(!$check)
        {   
            $days          = implode(',',$request->days);
            $exercise_name = implode(',',$request->exercise_name);
            $sets          = implode(',',$request->sets);
            $rep_range     = implode(',',$request->rep_range);
            $reference     = implode(',',$request->reference);
            $instructions  = implode(',',$request->instructions);

            $workout                = new Workout();
            $workout->days          = $days;
            $workout->workout_name  = $exercise_name;
            $workout->sets          = $sets;
            $workout->reps          = $rep_range;
            $workout->reference     = $reference;
            $workout->instructions  = $instructions;
            $workout->client_id     = $id;

            $workout_set = 1;

            if($workout->save())
            {
                session()->flash('success','Workout Added!');
                return redirect()->route('view.client',['id' => $id]);
            }
            else
            {
                session()->flash('error','Error! Please try again');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error','Workout for this client already exists!');
            return redirect()->route('view.client',['id' => $id]);
        }
    }

    public function edit_workout($id)
    {
        if($id)
        {
            $client_id = $id; 
            $workouts   = Workout::where('client_id',$id)->get();

           
            if ($workouts) 
            {
                return view('backend.trainer.clients.edit-workout', ['workouts' => $workouts]);
            }
            
            else
            {
                echo "Id not found";
            }
        }
        else
        {
            echo "Error";
        }
    }
}
