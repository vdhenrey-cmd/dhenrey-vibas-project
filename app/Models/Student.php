<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Hasfactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use Hasfactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'program',
        'gender',
        'birthday',
        'yr_level'
        
    ];
    protected $casts = [
        'birthday' => 'date'
    ]; 
    protected $appends = [
        'age'
    ];
    public function getAgeAttribute(){
        return $this->birthday?->age;
    }
}
