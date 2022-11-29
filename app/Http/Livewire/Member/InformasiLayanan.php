<?php

namespace App\Http\Livewire\Member;

use App\Models\Kontak;
use App\Models\OrganizationProfile;
use Livewire\Component;

class InformasiLayanan extends Component
{
    public function render()
    {
        return view('livewire.member.informasi-layanan', [
            'kontak' => Kontak::limit(1)->first(),
        ]);
    }
}
