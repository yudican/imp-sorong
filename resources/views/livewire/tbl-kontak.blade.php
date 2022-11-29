<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>kontak</span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-text-field type="text" name="alamat" label="Alamat" />
                    <x-text-field type="number" name="telepon" label="Telepon" />
                    <x-text-field type="text" name="email" label="Email" />
                    <x-text-field type="text" name="instagram" label="Instagram" />
                    <x-text-field type="text" name="youtube" label="Youtube" />
                    <x-text-field type="text" name="facebook" label="Facebook" />
                    <x-text-field type="text" name="website" label="Website" />

                    <div class="form-group">
                        <button class="btn btn-primary pull-right" wire:click="store">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>