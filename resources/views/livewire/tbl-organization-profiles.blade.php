<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>Profile Organisasi</span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-input-photo foto="{{$logo}}" path="{{optional($logo_path)->temporaryUrl()}}" name="logo_path"
                        label="Logo" />
                    <x-text-field type="date" name="tanggal_berdiri" label="Tanggal Berdiri" />
                    <div wire:ignore class="form-group @error('visi')has-error has-feedback @enderror">
                        <label for="visi" class="text-capitalize">Visi</label>
                        <textarea wire:model="visi" id="visi" class="form-control"></textarea>
                        @error('visi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div wire:ignore class="form-group @error('misi')has-error has-feedback @enderror">
                        <label for="misi" class="text-capitalize">Misi</label>
                        <textarea wire:model="misi" id="misi" class="form-control"></textarea>
                        @error('misi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div wire:ignore class="form-group @error('tugas_fungsi')has-error has-feedback @enderror">
                        <label for="tugas_fungsi" class="text-capitalize">Tugas Dan Fungsi</label>
                        <textarea wire:model="tugas_fungsi" id="tugas_fungsi" class="form-control"></textarea>
                        @error('tugas_fungsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right" wire:click="store">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{asset('assets/js/plugin/summernote/summernote-bs4.min.js')}}"></script>

    <script>
        document.addEventListener('livewire:load', function(e) {
            $('#visi').summernote({
                placeholder: 'visi',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('visi', contents);
                        }
                    }
            });
            
            $('#misi').summernote({
                placeholder: 'misi',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('misi', contents);
                        }
                    }
            });

            $('#tugas_fungsi').summernote({
                placeholder: 'tugas_fungsi',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('tugas_fungsi', contents);
                        }
                    }
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>