<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        

        <!-- Scripts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{  asset('Trumbowyg/dist/ui/trumbowyg.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}" defer></script>
        <script src="{{ asset('js/my.js') }}" defer></script>

        {{-- Bootstrap  --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">

        <div class="d-flex justify-content-end">
            <a href="/" class="border rounded-pill border-warning m-2 p-1 text-decoration-none bg-warning link-light">
                Odísť s admin panelu
            </a>
        </div>

        <div id="wrapper">
            <div class="overlay"></div>
             
                 <!-- Sidebar -->
            <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
              <ul class="nav sidebar-nav">
                <div class="sidebar-header">
                <div class="sidebar-brand">
                    <a href="#">{{ config('app.name', 'Laravel') }}</a>
                </div>
                </div>

                @hasanyrole('Manager|Admin')

                <li class="{{ (request()->is('admin/categories')) ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">Kategórie</a>
                </li>

                <li class="">
                    <a href="{{ route('contents.index') }}">Kontent</a>
                </li>

                @endhasanyrole

                @hasanyrole('Admin')

                <li class="{{ (request()->is('admin/users')) ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">Uživatelia</a>
                </li>

                @endhasanyrole
                <li class="{{ (request()->is('admin/menus')) ? 'active' : '' }}">
                    <a href="{{ route('admin.menus.index') }}">Menu</a>
                </li>

                <li class="{{ (request()->is('admin/tables')) ? 'active' : '' }}">
                    <a href="{{ route('admin.tables.index') }}">Stoly</a>
                </li>
                               
                <li class="{{ (request()->is('admin/rezervations')) ? 'active' : '' }}">
                    <a href="{{ route('admin.reservations.index') }}">Rezervácie</a>
                </li>

                <li class="dropdown">
                    <a href="#works" class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu animated fadeInLeft" role="menu">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
               </li>
               </ul>
            </nav>
                 <!-- /#sidebar-wrapper -->
         
                 <!-- Page Content -->
                 <div id="page-content-wrapper">
                     
                    <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button>


                    <div class="container">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('info'))
                            <div class="alert alert-{{ session('type')}}" id="flash-message">
                                <p>
                                    {{session('info')}}
                                </p>
                            </div>
                        @endif
                        {{ $slot }}         
                    </div>
                                
                     
                 </div>
                 <!-- /#page-content-wrapper -->
         
             </div>
             <!-- /#wrapper -->
    </body>
</html>
