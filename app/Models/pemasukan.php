<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $fillable = ['upload','tanggal_pemasukan','jumlah_pemsukan','kode_pemasukan','id_jenis_pemasukan','id_donatur'];
   
    public function jenis_pemasukan()
    {
        return $this->belongsTo(JenispPemasukan::class, 'id_pemasukan');
    }
    public function donatur()
    {
        return $this->belongsTo(User::class, 'id_donatur');
    }
}
