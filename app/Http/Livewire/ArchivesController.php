<?php

namespace App\Http\Livewire;

use App\Models\Archives;
use App\Models\JenisArsip;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ArchivesController extends Component
{
    use WithFileUploads;
    public $tbl_archives_id;
    public $nama_arsip;
    public $jenis_arsip;
    public $tanggal_arsip;
    public $file_arsip;
    public $jenis_arsip_id;
    public $file_arsip_path;


    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataArchivesById', 'getArchivesId'];

    public function mount()
    {
        if (!request()->segment(2)) return abort(404);
        $this->jenis_arsip_id = request()->segment(2);
    }

    public function render()
    {
        return view('livewire.tbl-archives', [
            'items' => Archives::all(),
            'jenis_arsips' => JenisArsip::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        $name = $this->file_arsip_path->getClientOriginalName();
        $this->file_arsip_path->storeAs('upload', $name, 'public');
        $data = [
            'nama_arsip'  => $this->nama_arsip,
            'jenis_arsip'  => $this->jenis_arsip,
            'tanggal_arsip'  => $this->tanggal_arsip,
            'file_arsip'  => $name,
            'jenis_arsip_id'  => $this->jenis_arsip_id,
        ];

        Archives::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'nama_arsip'  => $this->nama_arsip,
            'jenis_arsip'  => $this->jenis_arsip,
            'tanggal_arsip'  => $this->tanggal_arsip,
            'file_arsip'  => $this->file_arsip,
            'jenis_arsip_id'  => $this->jenis_arsip_id,
        ];
        $row = Archives::find($this->tbl_archives_id);

        if ($this->file_arsip_path) {
            $name = $this->file_arsip_path->getClientOriginalName();
            $this->file_arsip_path->storeAs('upload', $name, 'public');
            $data = ['file_arsip'  => $name];
            if (Storage::exists('public/' . $this->file_arsip)) {
                Storage::delete('public/' . $this->file_arsip);
            }
        }

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Archives::find($this->tbl_archives_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'nama_arsip'  => 'required',
            'tanggal_arsip'  => 'required',
        ];

        return $this->validate($rule);
    }

    public function getDataArchivesById($tbl_archives_id)
    {
        $this->_reset();
        $tbl_archives = Archives::find($tbl_archives_id);
        $this->tbl_archives_id = $tbl_archives->id;
        $this->nama_arsip = $tbl_archives->nama_arsip;
        $this->jenis_arsip = $tbl_archives->jenis_arsip;
        $this->tanggal_arsip = date('Y-m-d', strtotime($tbl_archives->tanggal_arsip));
        $this->file_arsip = $tbl_archives->file_arsip;
        $this->jenis_arsip_id = $tbl_archives->jenis_arsip_id;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getArchivesId($tbl_archives_id)
    {
        $tbl_archives = Archives::find($tbl_archives_id);
        $this->tbl_archives_id = $tbl_archives->id;
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
        $this->tbl_archives_id = null;
        $this->nama_arsip = null;
        $this->jenis_arsip = null;
        $this->tanggal_arsip = null;
        $this->file_arsip = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
