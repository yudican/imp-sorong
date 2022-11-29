<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('home.user')}}">
                            <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>{{$item->nama_beasiswa}}</span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <h5 class="card-title">{{$item->nama_beasiswa}}</h5>
                    <h6 class="card-subtitle text-muted">{{$item->tanggal_beasiswa->format('d M Y')}}
                    </h6>
                    <p class="card-text">{!! $item->deskripsi !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>