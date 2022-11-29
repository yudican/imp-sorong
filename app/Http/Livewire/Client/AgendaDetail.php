<?php

namespace App\Http\Livewire\Client;

use App\Models\Agenda;
use Livewire\Component;

class AgendaDetail extends Component
{
    public $item;


    public function mount($agenda_id)
    {
        if (!$agenda_id) return abort(404);
        $item = Agenda::find($agenda_id);
        if (!$item) return abort(404);

        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.client.agenda-detail')->layout('layouts.user');
    }
}
