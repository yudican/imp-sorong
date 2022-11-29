<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //use Uuid;
    use HasFactory;
    protected $table = 'agenda';
    //public $incrementing = false;

    protected $fillable = ['agenda_nama', 'agenda_tempat', 'agenda_tanggal', 'agenda_waktu', 'agenda_deskripsi'];

    protected $dates = ['agenda_tanggal', 'agenda_waktu'];
}
