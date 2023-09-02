<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Trainers;
use App\Models\Diets;
use Auth;
use DB;
use GuzzleHttp\Client;
class TrainerClientController extends Controller
{
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
        
        $client = Clients::find($id);
        if($client)
        {
            return view('backend.trainer.clients.client',['client' => $client]);
        }
        else
        {
            echo "Error";
        }
    }

    public function add_diet($id)
    {
      $client = Clients::select('name', 'medical_condition','id')->find($id);
      return view('backend.trainer.clients.add-diet',['client'=>$client]);
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
       
        $add_diet = new Diets();
        $trainer_id = Auth::guard('trainer')->user()->id;

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
            return redirect()->back();
        }
        else
        {
            session()->flash('error','Error! Please try again later');
            return redirect()->back();
        }
    }

  
}
