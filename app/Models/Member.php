<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $fillable = ['tempat_lahir', 'tanggal_lahir', 'agama_lahir', 'jenis_kelamin', 'nama_ayah', 'nama_ibu', 'nama_universitas', 'nama_prodi', 'nim', 'nama_bank', 'no_rekening', 'jenis_anggota_id', 'user_id'];

    protected $dates = ['tanggal_lahir'];


    /**
     * Get the user that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jenis_anggota that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisAnggota()
    {
        return $this->belongsTo(JenisAnggota::class);
    }
}
