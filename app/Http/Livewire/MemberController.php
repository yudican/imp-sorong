<?php

namespace App\Http\Livewire;

use App\Models\JenisAnggota;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class MemberController extends Component
{

    public $tbl_members_id;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $agama_lahir;
    public $jenis_kelamin = 'Laki-Laki';
    public $jenis_anggota_id;
    public $nama_ayah;
    public $nama_ibu;
    public $nama_universitas;
    public $nama_prodi;
    public $email;
    public $nim;
    public $nama_bank;
    public $no_rekening;
    public $nama;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataMemberById', 'getMemberId'];

    public function render()
    {
        return view('livewire..tbl-members', [
            'items' => Member::all(),
            'jenis_anggota' => JenisAnggota::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        $role_mentor = Role::where('role_type', 'member')->first();
        $user = User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make('anggota123'),
            'current_team_id' => 1,
        ]);
        $data = [
            'tempat_lahir'  => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'agama_lahir'  => $this->agama_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'nama_ayah'  => $this->nama_ayah,
            'nama_ibu'  => $this->nama_ibu,
            'nama_universitas'  => $this->nama_universitas,
            'nama_prodi'  => $this->nama_prodi,
            'nim'  => $this->nim,
            'nama_bank'  => $this->nama_bank,
            'no_rekening'  => $this->no_rekening,
            'jenis_anggota_id'  => $this->jenis_anggota_id,
            'user_id' => $user->id
        ];


        $user->roles()->attach($role_mentor->id);
        $user->teams()->attach(1, ['role' => $role_mentor->role_type]);

        Member::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'tempat_lahir'  => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'agama_lahir'  => $this->agama_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'nama_ayah'  => $this->nama_ayah,
            'nama_ibu'  => $this->nama_ibu,
            'nama_universitas'  => $this->nama_universitas,
            'nama_prodi'  => $this->nama_prodi,
            'nim'  => $this->nim,
            'nama_bank'  => $this->nama_bank,
            'no_rekening'  => $this->no_rekening,
            'jenis_anggota_id'  => $this->jenis_anggota_id,
        ];
        $row = Member::find($this->tbl_members_id);
        $row->user()->update([
            'name' => $this->nama,
            'email' => $this->email,
        ]);
        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Member::find($this->tbl_members_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'nama'  => 'required',
            'email'  => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir'  => 'required',
            'agama_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'nama_ayah'  => 'required',
            'nama_ibu'  => 'required',
            'nama_universitas'  => 'required',
            'nama_prodi'  => 'required',
            'nim'  => 'required',
        ];

        return $this->validate($rule);
    }

    public function getDataMemberById($tbl_members_id)
    {
        $this->_reset();
        $tbl_members = Member::find($tbl_members_id);
        $this->tbl_members_id = $tbl_members->id;
        $this->tempat_lahir = $tbl_members->tempat_lahir;
        $this->tanggal_lahir = date('Y-m-d', strtotime($tbl_members->tanggal_lahir));
        $this->nama = $tbl_members->user->name;
        $this->email = $tbl_members->user->email;
        $this->agama_lahir = $tbl_members->agama_lahir;
        $this->jenis_kelamin = $tbl_members->jenis_kelamin;
        $this->nama_ayah = $tbl_members->nama_ayah;
        $this->nama_ibu = $tbl_members->nama_ibu;
        $this->nama_universitas = $tbl_members->nama_universitas;
        $this->nama_prodi = $tbl_members->nama_prodi;
        $this->nim = $tbl_members->nim;
        $this->nama_bank = $tbl_members->nama_bank;
        $this->no_rekening = $tbl_members->no_rekening;
        $this->jenis_anggota_id = $tbl_members->jenis_anggota_id;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getMemberId($tbl_members_id)
    {
        $tbl_members = Member::find($tbl_members_id);
        $this->tbl_members_id = $tbl_members->id;
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
        $this->tbl_members_id = null;
        $this->tempat_lahir = null;
        $this->tanggal_lahir = null;
        $this->nama = null;
        $this->agama_lahir = null;
        $this->jenis_kelamin = null;
        $this->nama_ayah = null;
        $this->email = null;
        $this->nama_ibu = null;
        $this->nama_universitas = null;
        $this->nama_prodi = null;
        $this->nim = null;
        $this->jenis_anggota_id = null;
        $this->nama_bank = null;
        $this->no_rekening = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
