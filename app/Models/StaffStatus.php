<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffStatus extends Model
{
    use HasFactory;

    public $table = 'staff_status';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'staff_id');
    }

    public function volunteerStatus()
    {
        return $this->hasMany(Volunteer::class, 'staff_id');
    }

    protected $guarded = [];
}
