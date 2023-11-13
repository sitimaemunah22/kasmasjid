<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pemasukan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pemasukan';
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = ['nama_pemasukan'];
} 
