<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diets extends Model
{
    use HasFactory;

    protected $table ="diets"; 

    public function getmealsAttribute($value)
    {
        $meals = explode(',',$value);
        return  $meals;
    }
    public function getproteinAttribute($value)
    {
        $protein = explode(',',$value);
        return  $protein;
    }
    public function getCarbsAttribute($value)
    {
        $carbs = explode(',',$value);
        return  $carbs;
    }
    public function getFatsAttribute($value)
    {
        $fats = explode(',',$value);
        return  $fats;
    }
    public function getCaloriesAttribute($value)
    {
        $fats = explode(',',$value);
        return  $fats;
    }


    
}
