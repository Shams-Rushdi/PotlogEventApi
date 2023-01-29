<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $guarded = []; 
    protected $table = 'eventusers';
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
