<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengeluaran';
    protected $primaryKey = 'kode_pengeluaran';
    protected $fillable = ['upload','tanggal_pengeluaran','jumlah_pengeluaran'];
   
    public function jenis_pemasukan()
    {
        return $this->belongsTo(JenispPemasukan::class, 'id_pengeluaran');
    }

}
