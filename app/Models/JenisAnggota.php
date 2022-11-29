<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAnggota extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $table = 'jenis_anggota';

    protected $fillable = ['nama_jenis', 'keterangan'];

    protected $dates = [];
}
