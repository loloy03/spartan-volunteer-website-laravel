<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceCredit extends Model
{
    public $table = 'race_credit';//accessing the event table

    protected $primaryKey = 'event_id'; //changing the primary key

    public $timestamps = false; //disabling laravel's eloquent timestamps
}