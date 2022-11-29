<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    //use Uuid;
    use HasFactory;

    protected $table = 'kontak';

    //public $incrementing = false;

    protected $fillable = ['alamat', 'telepon', 'email', 'instagram', 'youtube', 'facebook', 'website'];

    protected $dates = [];
}
