<?php

namespace App\Http\Livewire;

use App\Models\Kontak;
use Livewire\Component;


class KontakController extends Component
{

    public $tbl_kontak_id;
    public $alamat;
    public $telepon;
    public $email;
    public $instagram;
    public $youtube;
    public $facebook;
    public $website;



    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataKontakById', 'getKontakId'];

    public function mount()
    {
        $kontak = Kontak::limit(1)->first();
        if ($kontak) {
            $this->tbl_kontak_id = $kontak->id;
            $this->alamat = $kontak->alamat;
            $this->telepon = $kontak->telepon;
            $this->email = $kontak->email;
            $this->instagram = $kontak->instagram;
            $this->youtube = $kontak->youtube;
            $this->facebook = $kontak->facebook;
            $this->website = $kontak->website;
        }
    }

    public function render()
    {
        return view('livewire.tbl-kontak', [
            'items' => Kontak::all()
        ]);
    }

    public function store()
    {
        $data = [
            'alamat'  => $this->alamat,
            'telepon'  => $this->telepon,
            'email'  => $this->email,
            'instagram'  => $this->instagram,
            'youtube'  => $this->youtube,
            'facebook'  => $this->facebook,
            'website'  => $this->website
        ];

        if ($this->tbl_kontak_id) {
            $kontak = Kontak::find($this->tbl_kontak_id);
            $kontak->update($data);
            return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
        }

        Kontak::create($data);
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }
}
