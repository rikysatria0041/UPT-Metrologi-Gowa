<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanTeraUlang extends Model
{
    use HasFactory;
    protected $table = 'permohonan_tera_ulang';
    protected $guarded = ['id'];

    public function jenisAlat()
    {
        return $this->belongsTo(JenisAlat::class);
    }
}
