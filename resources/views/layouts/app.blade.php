<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SUMBER JAYA</title>
    <!--{/{config('app.name', 'Laravel') }}-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        p{
            padding: 0px;
            margin: 0;
            font-size:17px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-body" id="noprint">
            <div class="container-fluid"  style="background-color:cadetblue; margin: 5px; padding-left: 20px;">
                <b> <a class="navbar-brand" href="\">Sumber Jaya</a> </b>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    <a class="nav-link" style="pointer-events: none; cursor: default;" href="#">|</a>
                    <a class="nav-link" href="\transaction">Penjualan</a>
                    <a class="nav-link" style="pointer-events: none; cursor: default;" href="#">|</a>
                    <a class="nav-link" href="\products" wire:click.prevent="productToggle()">Barang</a>
                    <a class="nav-link" style="pointer-events: none; cursor: default;" href="#">|</a>
                    </div>
                </div>
                <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            </li>
                        @endguest
                    </ul>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
				<div class='container-fluid' id='main'>{{isset($slot) ? $slot : null}}</div>
        </main>
    </div>
    @livewireScripts
    <script>
        window.addEventListener('openModal', event => {
            $("#ModalQty").modal('show');
            $('#ModalQty').on('shown.bs.modal', function() {
            $('#setfocus').focus();
            })
        })

        window.addEventListener('closeModal', event => {
            $("#ModalQty").modal('hide');
            $('#setfocusitem').focus();

        })

        window.addEventListener('openModalPrice', event => {
            $("#ModalPrice").modal('show');
            $('#ModalPrice').on('shown.bs.modal', function() {
            $('#setfocus2').focus();
            })
        })

        window.addEventListener('closeModalPrice', event => {
            $("#ModalPrice").modal('hide');
            $('#setfocusitem').focus();
        })

        window.addEventListener('openModalError', event => {
            $("#ModalError").modal('show');
        })

        window.addEventListener('openModalDelete', event => {
            $("#ModalDelete").modal('show');
        })

        window.addEventListener('closeModalDelete', event => {
            $("#ModalDelete").modal('hide');
        })

        window.addEventListener('printSellings', event => {
            $("#print").css("visibility","visible");
            $("#printcopy").css("visibility","visible");
            window.print();
            $("#print").css("visibility","hidden");
            $("#printcopy").css("visibility","visible");
        })

        </script>
</body>
</html>
