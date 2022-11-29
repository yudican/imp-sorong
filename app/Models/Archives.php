<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $fillable = ['nama_arsip', 'jenis_arsip', 'tanggal_arsip', 'file_arsip', 'jenis_arsip_id'];

    protected $dates = ['tanggal_arsip'];

    /**
     * Get the JenisArsip that owns the Archives
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisArsip()
    {
        return $this->belongsTo(JenisArsip::class);
    }
}
