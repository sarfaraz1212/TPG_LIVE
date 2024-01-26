<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslots extends Model
{
    use HasFactory;

    protected $fillable = ['trainer_id', 'day', 'starts_at', 'ends_at'];
}
