<?php

namespace App\Http\Livewire\Master;

use App\Models\JenisArsip;
use Livewire\Component;


class JenisArsipController extends Component
{

    public $tbl_jenis_arsip_id;
    public $nama_jenis_arsip;
    public $keterangan;



    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataJenisArsipById', 'getJenisArsipId'];

    public function render()
    {
        return view('livewire.master.tbl-jenis-arsip', [
            'items' => JenisArsip::all()
        ]);
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'nama_jenis_arsip'  => $this->nama_jenis_arsip,
            'keterangan'  => $this->keterangan
        ];

        JenisArsip::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'nama_jenis_arsip'  => $this->nama_jenis_arsip,
            'keterangan'  => $this->keterangan
        ];
        $row = JenisArsip::find($this->tbl_jenis_arsip_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        JenisArsip::find($this->tbl_jenis_arsip_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'nama_jenis_arsip'  => 'required',
        ];

        return $this->validate($rule);
    }

    public function getDataJenisArsipById($tbl_jenis_arsip_id)
    {
        $this->_reset();
        $tbl_jenis_arsip = JenisArsip::find($tbl_jenis_arsip_id);
        $this->tbl_jenis_arsip_id = $tbl_jenis_arsip->id;
        $this->nama_jenis_arsip = $tbl_jenis_arsip->nama_jenis_arsip;
        $this->keterangan = $tbl_jenis_arsip->keterangan;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getJenisArsipId($tbl_jenis_arsip_id)
    {
        $tbl_jenis_arsip = JenisArsip::find($tbl_jenis_arsip_id);
        $this->tbl_jenis_arsip_id = $tbl_jenis_arsip->id;
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
        $this->tbl_jenis_arsip_id = null;
        $this->nama_jenis_arsip = null;
        $this->keterangan = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
