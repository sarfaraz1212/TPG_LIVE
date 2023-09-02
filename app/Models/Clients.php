<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Models\Packages;

class Clients extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    
    // Implement the required methods from the Authenticatable contract
    
    public function getAuthIdentifierName()
    {
        return 'id'; // Replace 'id' with the actual primary key field name
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Return the primary key value
    }

    public function getAuthPassword()
    {
        return $this->password; // Return the password field
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Return the "remember me" token
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Set the "remember me" token
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Replace 'remember_token' with the actual column name
    }

    public function getGenderAttribute($value)
    {
        if ($value === 'M') 
        {
            return 'Male';
        }

        elseif ($value === 'F') 
        {
            return 'Female';
        }

        else 
        {
            return 'Other';
        }
        return $value;
    }


    public function getGoalsAttribute($value)
    {
        $goalArray = explode(',', $value);
        $array = [];

        foreach($goalArray as $goal)
        {
            if ($goal === 'MG') 
            {
                $array[] = 'Muscle Gain';
            } 
            elseif ($goal === 'FL') 
            {
                $array[] = 'Fat Loss';
            }

            elseif ($goal === 'GF') 
            {
                $array[] = 'General Fitness';
            }
        }
        $goals = implode(',',$array);
        return $goals; 
    }

    public function getPackageAttribute($value)
    {
        $find_package = Packages::find($value);
        $package_name = $find_package->package_name;
        return $package_name;
    }

    public function getPackageDurationAttribute()
    {
        if ($this->attributes['package']) {
            $package = Packages::find($this->attributes['package']);
            if ($package) {
                $packageDuration = (int)$package->package_duration; // Convert to integer for comparison
    
                switch ($packageDuration) {
                    case 1:
                        return '1 month';
                    case 3:
                        return '3 months';
                    case 6:
                        return '6 months';
                    case 12:
                        return '12 months';
                    default:
                        return 'Unknown'; 
                }
            }
        }
    
        return null; 
    }
    




    // Other methods...
}
