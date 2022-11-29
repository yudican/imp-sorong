<?php

namespace App\Http\Livewire\Informasi;

use App\Models\Beasiswa;
use Livewire\Component;


class BeasiswaController extends Component
{

    public $tbl_beasiswa_id;
    public $nama_beasiswa;
    public $tanggal_beasiswa;
    public $deskripsi;



    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataBeasiswaById', 'getBeasiswaId'];

    public function render()
    {
        return view('livewire.informasi.tbl-beasiswa', [
            'items' => Beasiswa::all()
        ]);
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'nama_beasiswa'  => $this->nama_beasiswa,
            'tanggal_beasiswa'  => $this->tanggal_beasiswa,
            'deskripsi'  => $this->deskripsi
        ];

        Beasiswa::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'nama_beasiswa'  => $this->nama_beasiswa,
            'tanggal_beasiswa'  => $this->tanggal_beasiswa,
            'deskripsi'  => $this->deskripsi
        ];
        $row = Beasiswa::find($this->tbl_beasiswa_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Beasiswa::find($this->tbl_beasiswa_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'nama_beasiswa'  => 'required',
            'tanggal_beasiswa'  => 'required',
            'deskripsi'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataBeasiswaById($tbl_beasiswa_id)
    {
        $this->_reset();
        $tbl_beasiswa = Beasiswa::find($tbl_beasiswa_id);
        $this->tbl_beasiswa_id = $tbl_beasiswa->id;
        $this->nama_beasiswa = $tbl_beasiswa->nama_beasiswa;
        $this->tanggal_beasiswa = date('Y-m-d', strtotime($tbl_beasiswa->tanggal_beasiswa));
        $this->deskripsi = $tbl_beasiswa->deskripsi;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getBeasiswaId($tbl_beasiswa_id)
    {
        $tbl_beasiswa = Beasiswa::find($tbl_beasiswa_id);
        $this->tbl_beasiswa_id = $tbl_beasiswa->id;
    }

    public function toggleForm($form)
    {
        $this->_reset();
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->tbl_beasiswa_id = null;
        $this->nama_beasiswa = null;
        $this->tanggal_beasiswa = null;
        $this->deskripsi = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
