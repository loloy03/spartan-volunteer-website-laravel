<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    
    public $table = 'event';//accessing the event table

    protected $primaryKey = 'event_id'; //changing the primary key

    public $timestamps = false; //disabling laravel's eloquent timestamps
}