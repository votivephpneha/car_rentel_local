<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pages extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'pages';

    protected $primaryKey = 'id'; 

}
