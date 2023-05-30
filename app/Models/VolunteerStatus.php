<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerStatus extends Model
{
    public $table = 'volunteer_status';//accessing the table

    public $timestamps = false; //disabling laravel's eloquent timestamps

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function staffStatus()
    {
        return $this->belongsTo(StaffStatus::class, 'staff_id');
    }
    
    protected $fillable = [
        'check_in',
        'check_in',
        'attendance_status',
        'role',
    ];

    // public $guarded = [];
}
