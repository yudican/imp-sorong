<div class="page-inner">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-capitalize">
                <a href="{{route('dashboard')}}">
                    <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Informasi Layanan</span>
                </a>
            </h4>
        </div>
    </div>
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