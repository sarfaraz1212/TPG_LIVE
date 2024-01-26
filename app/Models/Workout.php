<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function getdaysAttribute($value)
    {
        $days = explode(',',$value);
        return $days;
    }

    public function getexercisenameAttribute($value)
    {
        $exercise_name = explode(',',$value);
        return $exercise_name;
    }

    public function getsetsAttribute($value)
    {
        $sets = explode(',',$value);
        return $sets;
    }

    public function getrepsAttribute($value)
    {
        $reps = explode(',',$value);
        return $reps;
    }

    public function getreferenceAttribute($value)
    {
        $reference = explode(',',$value);
        return $reference;
    }

    public function getinstructionsAttribute($value)
    {
        $instructions = explode(',',$value);
        return $instructions;
    }

  

}
