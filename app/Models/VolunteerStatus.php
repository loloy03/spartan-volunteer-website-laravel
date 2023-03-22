<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerStatus extends Model
{
    
    public $table = 'volunteer_status';//accessing the event table

    protected $primaryKey = 'event_id'; //changing the primary key

    public $timestamps = false; //disabling laravel's eloquent timestamps
}
