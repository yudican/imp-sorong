<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;
    protected $table = 'jenis_arsip';

    protected $fillable = ['nama_jenis_arsip', 'keterangan'];

    protected $dates = [];
}
