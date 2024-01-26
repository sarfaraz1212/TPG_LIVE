<?php

namespace App\Http\Controllers\backend\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Trainers;
use App\Models\Clients;
use App\Models\Workout;

class ClientWorkoutController extends Controller
{
    public function view()
    {
        $client_id = Auth::guard('client')->id();

        $assigned_trainer = Clients::with('trainer')->where('id',$client_id)->first();
        if($assigned_trainer)
        {
            $workouts = Workout::where('client_id',$client_id)->get();
            $trainer = $assigned_trainer->trainer->name;

            if($trainer)
            {
                return view('backend.client.workout.view',compact('trainer','workouts'));
            }
            else
            {
                return view('backend.client.workout.view');
            }
        };   
    }
}
