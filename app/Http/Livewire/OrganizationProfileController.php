<?php

namespace App\Http\Livewire;

use App\Models\OrganizationProfile;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class OrganizationProfileController extends Component
{
    use WithFileUploads;
    public $tbl_organization_profiles_id;
    public $logo;
    public $tanggal_berdiri;
    public $visi;
    public $misi;
    public $tugas_fungsi;
    public $logo_path;


    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataOrganizationProfileById', 'getOrganizationProfileId'];

    public function mount()
    {
        $profile = OrganizationProfile::limit(1)->first();
        if ($profile) {
            $this->getDataOrganizationProfileById($profile->id);
        }
    }

    public function render()
    {
        return view('livewire.tbl-organization-profiles', [
            'items' => OrganizationProfile::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        $profile = OrganizationProfile::limit(1)->first();
        $data = [
            'tanggal_berdiri'  => $this->tanggal_berdiri,
            'visi'  => $this->visi,
            'misi'  => $this->misi,
            'tugas_fungsi'  => $this->tugas_fungsi
        ];

        if ($profile) {
            if ($this->logo_path) {
                $logo = $this->logo_path->store('upload', 'public');
                $data = ['logo' => $logo];
                if (Storage::exists('public/' . $this->logo)) {
                    Storage::delete('public/' . $this->logo);
                }
            }
        } else {
            $logo = $this->logo_path->store('upload', 'public');
            $data = ['logo'  => $logo];
        }

        $profile ? $profile->update($data) : OrganizationProfile::create($data);

        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function _validate()
    {
        $rule = [
            'tanggal_berdiri'  => 'required',
            'visi'  => 'required',
            'misi'  => 'required',
            'tugas_fungsi'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataOrganizationProfileById($tbl_organization_profiles_id)
    {
        $tbl_organization_profiles = OrganizationProfile::find($tbl_organization_profiles_id);
        $this->tbl_organization_profiles_id = $tbl_organization_profiles->id;
        $this->logo = $tbl_organization_profiles->logo;
        $this->tanggal_berdiri = date('Y-m-d', strtotime($tbl_organization_profiles->tanggal_berdiri));
        $this->visi = $tbl_organization_profiles->visi;
        $this->misi = $tbl_organization_profiles->misi;
        $this->tugas_fungsi = $tbl_organization_profiles->tugas_fungsi;
    }
}
