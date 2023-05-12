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

    protected $guarded = [];
}
