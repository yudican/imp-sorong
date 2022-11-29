<div class="page-inner">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Anggota</p>
                                <h4 class="card-title">{{$jumlah_anggota}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-file"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Arsip</p>
                                <h4 class="card-title">{{$jumlah_arsip}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- visi misi --}}
    <div>
        <h2 class="text-bold">Profil Himpunan</h2>
        <div class="card card-stats card-round">
            <div class="card-body ">
                <h5 class="card-title">Visi</h5>
                <p class="card-text">{!! $profile->visi !!}</p>
            </div>
        </div>
        <div class="card card-stats card-round">
            <div class="card-body ">
                <h5 class="card-title">Misi</h5>
                <p class="card-text">{!! $profile->misi !!}</p>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-bold">Informasi Agenda Kegiatan</h2>
        <div class="row">
            @foreach ($agenda as $item)
            <div class="col-md-6">
                <a href="{{route('agenda-detail', ['agenda_id' => $item->id])}}" style="text-decoration: none;">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <h5 class="card-title">{{$item->agenda_nama}}</h5>
                            <h6 class="card-subtitle text-muted">{{$item->agenda_tempat}} -
                                {{$item->agenda_tanggal->format('d M Y')}}
                            </h6>
                            {{-- <p class="card-text">{!! $item->agenda_deskripsi !!}</p> --}}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div>
        <h2 class="text-bold">Informasi Beasiswa</h2>
        <div class="row">
            @foreach ($beasiswa as $item_beasiswa)
            <div class="col-md-6">
                <a href="{{route('beasiswa-detail', ['beasiswa_id' => $item_beasiswa->id])}}"
                    style="text-decoration: none;color:#000;">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <h5 class="card-title">{{$item_beasiswa->nama_beasiswa}}</h5>
                            <h6 class="card-subtitle text-muted">{{$item_beasiswa->tanggal_beasiswa->format('d M Y')}}
                            </h6>
                            <p class="card-text text-black">{!! substr(strip_tags($item_beasiswa->deskripsi),0,300) !!}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div>
        <h2 class="text-bold">Informasi Layanan</h2>
        <div class="card card-stats card-round">
            <div class="card-body ">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        alamat
                        <span>{{$kontak->alamat}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        telepon
                        <span>{{$kontak->telepon}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        email
                        <span>{{$kontak->email}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        instagram
                        <span>{{$kontak->instagram}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        youtube
                        <span>{{$kontak->youtube}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        facebook
                        <span>{{$kontak->facebook}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize">
                        website
                        <span>{{$kontak->website}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>