<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>members</span>
                        </a>
                        <div class="pull-right">
                            @if (auth()->user()->hasTeamPermission($curteam, request()->route()->getName().':create'))
                            @if ($form_active)
                            <button class="btn btn-danger btn-sm" wire:click="toggleForm(false)"><i
                                    class="fas fa-times"></i> Cancel</button>
                            @else
                            <button class="btn btn-primary btn-sm"
                                wire:click="{{$modal ? 'showModal' : 'toggleForm(true)'}}"><i class="fas fa-plus"></i>
                                Add
                                New</button>
                            @endif
                            @endif
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if ($form_active)
            <div class="card">
                <div class="card-body row">
                    <div class="col-md-6">
                        <x-text-field type="text" name="nama" label="Nama Lengkap" />
                        <x-text-field type="text" name="email" label="Email" />
                        <x-text-field type="text" name="nim" label="Nim" />
                        <x-text-field type="text" name="tempat_lahir" label="Tempat Lahir" />
                        <x-text-field type="date" name="tanggal_lahir" label="Tanggal Lahir" />
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
                    </div>
                    <div class="col-md-6">
                        <x-select name="jenis_anggota_id" label="Jenis Anggota">
                            <option value="">Select Jenis Anggota</option>
                            @foreach ($jenis_anggota as $jenis)
                            <option value="{{$jenis->id}}">{{$jenis->nama_jenis}}</option>
                            @endforeach
                        </x-select>
                        <x-text-field type="text" name="nama_ayah" label="Nama Ayah" />
                        <x-text-field type="text" name="nama_ibu" label="Nama Ibu" />
                        <x-text-field type="text" name="nama_universitas" label="Nama Universitas" />
                        <x-text-field type="text" name="nama_prodi" label="Nama Prodi" />

                        <x-text-field type="text" name="nama_bank" label="Nama Bank" />
                        <x-text-field type="text" name="no_rekening" label="No Rekening" />
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right"
                            wire:click="{{$update_mode ? 'update' : 'store'}}">Simpan</button>
                    </div>
                </div>
            </div>
            @else
            <livewire:table.member-table />
            @endif

        </div>

        {{-- Modal confirm --}}
        <div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog"
            aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus data ini.?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i
                                class="fa fa-check pr-2"></i>Ya, Hapus</button>
                        <button class="btn btn-primary btn-sm" wire:click='_reset'><i
                                class="fa fa-times pr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')



    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('loadForm', (data) => {
                
                
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>