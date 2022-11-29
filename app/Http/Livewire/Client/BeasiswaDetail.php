<?php

namespace App\Http\Livewire\Client;

use App\Models\Beasiswa;
use Livewire\Component;

class BeasiswaDetail extends Component
{
    public $item;


    public function mount($beasiswa_id)
    {
        if (!$beasiswa_id) return abort(404);
        $item = Beasiswa::find($beasiswa_id);
        if (!$item) return abort(404);

        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.client.beasiswa-detail')->layout('layouts.user');
    }
}
