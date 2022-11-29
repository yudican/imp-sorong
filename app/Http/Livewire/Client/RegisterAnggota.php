<?php

namespace App\Http\Livewire\Client;

use App\Models\JenisAnggota;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterAnggota extends Component
{
    public $tempat_lahir;
    public $tanggal_lahir;
    public $agama_lahir;
    public $jenis_kelamin = 'Laki-Laki';
    public $jenis_anggota_id;
    public $nama_ayah;
    public $nama_ibu;
    public $nama_universitas;
    public $nama_prodi;
    public $nim;
    public $nama_bank;
    public $no_rekening;

    public $email;
    public $nama;
    public $password;

    public function render()
    {
        return view('livewire.client.register-anggota', [
            'jenis_anggota' => JenisAnggota::all()
        ])->layout('layouts.user');
    }

    public function store()
    {
        $this->_validate();
        try {
            DB::beginTransaction();
            $role_mentor = Role::where('role_type', 'member')->first();
            $user = User::create([
                'name' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->password),
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
            DB::commit();
            $this->_reset();
            return $this->emit('showAlert', ['msg' => 'Registrasi Berhasil Silahkan Login']);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->emit('showAlertError', ['msg' => 'Registrasi Gagal, Mohon Ulangi Kembali']);
        }
    }

    public function _validate()
    {
        $rule = [
            'nama'  => 'required',
            'email'  => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'tempat_lahir'  => 'required',
            'tanggal_lahir'  => 'required',
            'agama_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'nama_ayah'  => 'required',
            'nama_ibu'  => 'required',
            'nama_universitas'  => 'required',
            'nama_prodi'  => 'required',
            'nim'  => 'required|numeric',
            'nama_bank'  => 'required',
            'no_rekening'  => 'required|numeric',
            'jenis_anggota_id'  => 'required',
        ];

        return $this->validate($rule);
    }


    public function _reset()
    {
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
        $this->password = null;
    }
}
