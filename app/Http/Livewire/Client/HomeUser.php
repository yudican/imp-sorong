<?php

namespace App\Http\Livewire\Client;

use App\Models\Agenda;
use App\Models\Archive;
use App\Models\Beasiswa;
use App\Models\Kontak;
use App\Models\Member;
use App\Models\OrganizationProfile;
use Livewire\Component;

class HomeUser extends Component
{
    public function render()
    {
        return view('livewire.client.home-user', [
            'jumlah_anggota' => Member::count(),
            'jumlah_arsip' => Archive::count(),
            'arsip' => Archive::all(),
            'beasiswa' => Beasiswa::all(),
            'agenda' => Agenda::all(),
            'profile' => OrganizationProfile::limit(1)->first(),
            'kontak' => Kontak::limit(1)->first(),
        ])->layout('layouts.user');
    }
}
