<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $table = 'beasiswa';

    protected $fillable = ['nama_beasiswa', 'tanggal_beasiswa', 'deskripsi'];

    protected $dates = ['tanggal_beasiswa'];
}
