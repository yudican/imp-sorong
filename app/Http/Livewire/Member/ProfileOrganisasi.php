<?php

namespace App\Http\Livewire\Member;

use App\Models\Kontak;
use App\Models\OrganizationProfile;
use Livewire\Component;

class ProfileOrganisasi extends Component
{
    public function render()
    {
        return view('livewire.member.profile-organisasi', [
            'profile' => OrganizationProfile::limit(1)->first(),
        ]);
    }
}
