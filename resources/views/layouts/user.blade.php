<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="icon" href="{{asset('assets/img/icon.ico')}}" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
  <script>
    WebFont.load({
        			google: {"families":["Lato:300,400,700,900"]},
        			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: [`{{asset('assets/css/fonts.min.css')}}`]},
        			active: function() {
        				sessionStorage.fonts = true;
        			}
        		});
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/atlantis2.css')}}">

  <!-- Styles -->
  {{--
  <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
  @stack('styles')
  @livewireStyles
  <style>
    .cursor-pointer {
      cursor: pointer;
    }

    .cursor-default {
      cursor: default;
    }

    .absolute {
      position: absolute;
      bottom: 5px;
      left: 5px;
    }

    .table td,
    .table th {
      font-size: 14px;
      border-top-width: 0px;
      border-bottom: 1px solid;
      border-color: #ebedf2 !important;
      padding: 0 10px !important;
      height: 60px;
      vertical-align: middle !important;
    }

    .navbar .navbar-nav .nav-item .nav-link:hover {
      background-color: #fff !important;
      color: black border-radius:5px
    }

    .navbar .navbar-nav .nav-item {
      margin-right: 0;
    }

    .navbar .navbar-nav .nav-item:hover {
      background-color: #fff !important;
    }

    .btn-default {
      background-color: #fff;
    }

    .main-header[data-background-color="white"] .navbar-nav .nav-item .nav-link:hover,
    .main-header[data-background-color="white"] .navbar-nav .nav-item .nav-link:focus,
    .main-header.fixed[data-background-color="transparent"] .navbar-nav .nav-item .nav-link:hover,
    .main-header.fixed[data-background-color="transparent"] .navbar-nav .nav-item .nav-link:focus {
      background: #fff !important;
    }
  </style>
  <!-- Scripts -->
  {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</head>

<body class="font-sans antialiased" style="background-color: #fff;">
  <div class="wrapper">

    <div class="main-header shadow-sm" data-background-color="white">
      <div class="container">
        <nav class="navbar navbar-expand-lg">
          <img src="{{asset('storage/'.$profile->logo)}}" height="50" alt="navbar brand" class="navbar-brand">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (!Auth::check())
            <ul class="navbar-nav ml-auto">
              <li class="nav-item text-center">
                <a class="nav-link" href="{{route('register-anggota')}}"><strong>Daftar</strong></a>
              </li>
              <li class="nav-item text-center">
                <a class="nav-link" href="{{ route('login') }}"><strong>Login</strong></a>
              </li>
            </ul>
            @else
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
              </li>
            </ul>
            @endif
          </div>
        </nav>
      </div>
    </div>

    <div class="main-panel">
      <div class="container">{{$slot}}</div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="copyright ml-auto">
          <span>Imp Sorong</span>
        </div>
      </div>
    </footer>
  </div>


  <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

  <!-- jQuery UI -->
  <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>


  <!-- jQuery Scrollbar -->
  <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/atlantis2.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @stack('scripts')
  <script>
    document.addEventListener('livewire:load', function(e) {
      window.livewire.on('showAlert', ({msg, redirect=false, path='/'}) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: msg,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })

                        if (redirect) {
                            setTimeout(() => {
                                window.location.href=path
                            }, 3000);
                        }
                    });
                    
                    window.livewire.on('showAlertError', (data) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.msg,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    });
                })
  </script>
  @livewireScripts
</body>

</html>