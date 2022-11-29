<?php

namespace App\Http\Livewire;

use App\Models\Agenda;
use App\Models\Archive;
use App\Models\Beasiswa;
use App\Models\Member;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'jumlah_anggota' => Member::count(),
            'jumlah_arsip' => Archive::count(),
            'jumlah_agenda' => Agenda::count(),
            'jumlah_beasiswa' => Beasiswa::count(),
        ]);
    }
}
