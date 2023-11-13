<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Notifications\Notifiable;
use laravel\Sanctum\HasApiTokens;

class Auth extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'kode';
    protected $primaryKey = 'nik';
    public $timestamps = false;
    protected $fillable = [
        'username','password','role'
    ];

}
