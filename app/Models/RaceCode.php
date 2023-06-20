<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceCode extends Model
{
    public $table = 'race_code';//accessing the event table

    protected $primaryKey = 'volunteer_id'; //changing the primary key

    public $timestamps = false; //disabling laravel's eloquent timestamps

    protected $guarded = [];

    public function raceCredit()
    {
        return $this->hasOne(RaceCredit::class, 'credit_id');
    }

    public function raceType()
    {
        //
    }
}

