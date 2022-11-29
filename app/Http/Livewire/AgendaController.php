<?php

namespace App\Http\Livewire;

use App\Models\Agenda;
use Livewire\Component;


class AgendaController extends Component
{

    public $tbl_agenda_id;
    public $agenda_nama;
    public $agenda_tempat;
    public $agenda_tanggal;
    public $agenda_waktu;
    public $agenda_deskripsi;



    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataAgendaById', 'getAgendaId'];

    public function render()
    {
        return view('livewire.tbl-agenda', [
            'items' => Agenda::all()
        ]);
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'agenda_nama'  => $this->agenda_nama,
            'agenda_tempat'  => $this->agenda_tempat,
            'agenda_tanggal'  => $this->agenda_tanggal,
            'agenda_waktu'  => $this->agenda_waktu,
            'agenda_deskripsi'  => $this->agenda_deskripsi
        ];

        Agenda::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'agenda_nama'  => $this->agenda_nama,
            'agenda_tempat'  => $this->agenda_tempat,
            'agenda_tanggal'  => $this->agenda_tanggal,
            'agenda_waktu'  => $this->agenda_waktu,
            'agenda_deskripsi'  => $this->agenda_deskripsi
        ];
        $row = Agenda::find($this->tbl_agenda_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Agenda::find($this->tbl_agenda_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'agenda_nama'  => 'required',
            'agenda_tempat'  => 'required',
            'agenda_tanggal'  => 'required',
            'agenda_waktu'  => 'required',
            'agenda_deskripsi'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataAgendaById($tbl_agenda_id)
    {
        $this->_reset();
        $tbl_agenda = Agenda::find($tbl_agenda_id);
        $this->tbl_agenda_id = $tbl_agenda->id;
        $this->agenda_nama = $tbl_agenda->agenda_nama;
        $this->agenda_tempat = $tbl_agenda->agenda_tempat;
        $this->agenda_tanggal = date('Y-m-d', strtotime($tbl_agenda->agenda_tanggal));
        $this->agenda_waktu = date('H:i', strtotime($tbl_agenda->agenda_waktu));
        $this->agenda_deskripsi = $tbl_agenda->agenda_deskripsi;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getAgendaId($tbl_agenda_id)
    {
        $tbl_agenda = Agenda::find($tbl_agenda_id);
        $this->tbl_agenda_id = $tbl_agenda->id;
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
        $this->tbl_agenda_id = null;
        $this->agenda_nama = null;
        $this->agenda_tempat = null;
        $this->agenda_tanggal = null;
        $this->agenda_waktu = null;
        $this->agenda_deskripsi = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
