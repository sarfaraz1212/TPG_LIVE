<?php

namespace App\Http\Controllers\backend\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Diets;

class ClientDietController extends Controller
{
    public function view()
    {
        $client_id = Auth::guard('client')->user()->id;

        $trainerId = DB::table('clients')->where('id', $client_id)->value('assigned_trainer');
        $trainer = DB::table('trainers')->where('id', $trainerId)->first();
        
        $diets = Diets::where('client_id', $client_id)->get();

        return view('backend.client.diet.list', compact('diets', 'trainer'));
    }


}
