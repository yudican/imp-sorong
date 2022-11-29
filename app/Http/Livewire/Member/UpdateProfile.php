<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $agama_lahir;
    public $jenis_kelamin = 'Laki-Laki';
    public $nama_ayah;
    public $nama_ibu;
    public $nama_universitas;
    public $nama_prodi;
    public $nim;
    public $nama_bank;
    public $no_rekening;

    public $email;
    public $nama;
    public $profile_photo;
    public $profile_photo_path;

    public function mount()
    {
        $this->_getProfile();
    }

    public function render()
    {
        return view('livewire.member.update-profile');
    }

    public function store()
    {
        $this->_validate();
        try {
            DB::beginTransaction();
            $user = auth()->user();
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
            ];

            $data_user = [
                'name' => $this->nama,
                'email' => $this->email,
            ];

            if ($this->profile_photo_path) {
                $name = $this->profile_photo_path->getClientOriginalName();
                $this->profile_photo_path->storeAs('upload', $name, 'public');
                $data_user = ['profile_photo_path'  => 'upload/' . $name];
                if (Storage::exists('public/' . $this->profile_photo)) {
                    Storage::delete('public/' . $this->profile_photo);
                }
            }

            $user->update($data_user);
            $user->member()->update($data);
            $this->_getProfile();
            DB::commit();
            return $this->emit('showAlert', ['msg' => 'Update profile berhasil']);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->emit('showAlertError', ['msg' => 'Update profile gagal' . $th->getMessage()]);
        }
    }

    public function _getProfile()
    {
        $user = auth()->user();
        $member = Member::find($user->member->id);
        $this->member_id = $member->id;
        $this->tempat_lahir = $member->tempat_lahir;
        $this->tanggal_lahir = date('Y-m-d', strtotime($member->tanggal_lahir));
        $this->nama = $member->user->name;
        $this->email = $member->user->email;
        $this->agama_lahir = $member->agama_lahir;
        $this->jenis_kelamin = $member->jenis_kelamin;
        $this->nama_ayah = $member->nama_ayah;
        $this->nama_ibu = $member->nama_ibu;
        $this->nama_universitas = $member->nama_universitas;
        $this->nama_prodi = $member->nama_prodi;
        $this->nim = $member->nim;
        $this->nama_bank = $member->nama_bank;
        $this->no_rekening = $member->no_rekening;
        $this->profile_photo = $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : Auth::user()->profile_photo_url;
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
            'nim'  => 'required|numeric',
            'nama_bank'  => 'required',
            'no_rekening'  => 'required|numeric',
        ];

        return $this->validate($rule);
    }
}
