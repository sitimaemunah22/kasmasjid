<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donatur extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';
    protected $fillable = ['nama','alamat','no_telephone','upload'];
}
