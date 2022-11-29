<?php

namespace App\Http\Livewire\Master;

use App\Models\JenisAnggota;
use Livewire\Component;


class JenisAnggotaController extends Component
{

    public $tbl_jenis_anggota_id;
    public $nama_jenis;
    public $keterangan;



    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataJenisAnggotaById', 'getJenisAnggotaId'];

    public function render()
    {
        return view('livewire.master.tbl-jenis-anggota', [
            'items' => JenisAnggota::all()
        ]);
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'nama_jenis'  => $this->nama_jenis,
            'keterangan'  => $this->keterangan
        ];

        JenisAnggota::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'nama_jenis'  => $this->nama_jenis,
            'keterangan'  => $this->keterangan
        ];
        $row = JenisAnggota::find($this->tbl_jenis_anggota_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        JenisAnggota::find($this->tbl_jenis_anggota_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'nama_jenis'  => 'required',
        ];

        return $this->validate($rule);
    }

    public function getDataJenisAnggotaById($tbl_jenis_anggota_id)
    {
        $this->_reset();
        $tbl_jenis_anggota = JenisAnggota::find($tbl_jenis_anggota_id);
        $this->tbl_jenis_anggota_id = $tbl_jenis_anggota->id;
        $this->nama_jenis = $tbl_jenis_anggota->nama_jenis;
        $this->keterangan = $tbl_jenis_anggota->keterangan;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getJenisAnggotaId($tbl_jenis_anggota_id)
    {
        $tbl_jenis_anggota = JenisAnggota::find($tbl_jenis_anggota_id);
        $this->tbl_jenis_anggota_id = $tbl_jenis_anggota->id;
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
        $this->tbl_jenis_anggota_id = null;
        $this->nama_jenis = null;
        $this->keterangan = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
