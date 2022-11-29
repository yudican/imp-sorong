<div class="page-inner">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-capitalize">
                <a href="{{route('dashboard')}}">
                    <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Profile Organisasi</span>
                </a>
            </h4>
        </div>
    </div>
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