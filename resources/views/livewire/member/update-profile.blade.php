<div class="page-inner">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-capitalize">
                <a href="{{route('dashboard')}}">
                    <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Update Profile</span>
                </a>
            </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body row">
            <div class="col-md-6">
                <x-input-photo-profile foto="{{$profile_photo}}"
                    path="{{optional($profile_photo_path)->temporaryUrl()}}" name="profile_photo_path"
                    label="Foto Profile" />
                <x-text-field type="text" name="nama" label="Nama Lengkap" />
                <x-text-field type="text" name="email" label="Email" />
                <x-text-field type="text" name="nim" label="Nim" />
                <x-text-field type="text" name="tempat_lahir" label="Tempat Lahir" />
                <x-text-field type="date" name="tanggal_lahir" label="Tanggal Lahir" />
            </div>
            <div class="col-md-6">
                <x-select name="agama_lahir" label="Agama Lahir">
                    <option value="">Select Agama Lahir</option>
                    <option value="islam">Islam</option>
                    <option value="khatolik">Khatolik</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                    <option value="kristen">Kristen</option>
                    <option value="konghucu">Konghucu</option>
                </x-select>
                <x-select name="jenis_kelamin" label="Jenis Kelamin">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </x-select>
                <x-text-field type="text" name="nama_ayah" label="Nama Ayah" />
                <x-text-field type="text" name="nama_ibu" label="Nama Ibu" />
                <x-text-field type="text" name="nama_universitas" label="Nama Universitas" />
                <x-text-field type="text" name="nama_prodi" label="Nama Prodi" />
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <x-text-field type="text" name="nama_bank" label="Nama Bank" />
                    </div>
                    <div class="col-md-6 pl-0">
                        <x-text-field type="text" name="no_rekening" label="No Rekening" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 ml-auto">
                <div class="form-group">
                    <button class="btn btn-primary pull-right" wire:click="store">Simpan</button>
                </div>
            </div>
        </div>

    </div>
</div>
</div>