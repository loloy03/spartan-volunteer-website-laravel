<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Authenticatable
{
    use HasFactory;

    public $table = 'admin';
    protected $primaryKey = 'admin_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }
}
