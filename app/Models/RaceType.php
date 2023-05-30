<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceType extends Model
{
    use HasFactory;

    public $table = 'race_types';//accessing the event table

    protected $primaryKey = 'race_id'; //changing the primary key

    public $timestamps = false; //disabling laravel's eloquent timestamps

    public $guarded = [];
}
