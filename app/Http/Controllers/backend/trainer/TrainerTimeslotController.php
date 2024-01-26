<?php

namespace App\Http\Controllers\backend\trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeslots;
use Auth;

class TrainerTimeslotController extends Controller
{
    public function index()
    {
        return view('backend.trainer.timeslots');
    }

    public function add(Request $request)
    {

        $trainerId = Auth::guard('trainer')->user()->id;

        $slots = explode(', ', $request->selected_slots);

        foreach ($slots as $slot) {
           
            list($day, $times) = explode(': ', $slot);
            list($startsAt, $endsAt) = explode(' - ', $times);
    
            Timeslots::create([
                'trainer_id' => $trainerId,
                'day' => $day,
                'starts_at' => $startsAt,
                'ends_at' => $endsAt,
            ]);
        }

        session()->flash('success','Time slots saved Successfully!');
        return redirect()->back();
    }
}
