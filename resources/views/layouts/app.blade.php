<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.nice-number.js') }}?v=2"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}?v=5" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-friends"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        @if(in_array(Auth::id(), config('app.admin_id')))
                        
                            @if(Helper::getNotificationCount() != 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin#list-reservation">
                                        <div class="notification">
                                        {{ Helper::getNotificationCount() }}
                                        </div>
                                    </a>     
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Admin Panel</a>
                            </li>
                        @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(!in_array(Auth::id(), config('app.admin_id')))
                                    <a data-toggle="modal" data-target="#manageTableModal" class="dropdown-item" href="#"><i class="fas fa-tasks"></i> Manage My Table</a>
                                    @endif
                                    <a data-toggle="modal" data-target="#userSettingModal" class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>                               
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main style="padding-top: 150px !important;" class="py-4">
            @yield('content')

        </main>

         @guest
        @else
        <!--- Manage User Ordered Modal !--->
        <div class="modal fade" id="userSettingModal" tabindex="-1" role="dialog" aria-labelledby="userSettingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userSettingModalLabel">EDIT {{ Auth::user()->name }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Current password</label>
                                <input id="setting-cur_password" type="password" class="form-control" name="cur_password" value="" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Name</label>
                                <input id="setting-name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Email</label>
                                <input id="setting-email" type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>New password</label>
                                <input id="setting-password" type="password" class="form-control" name="password" value="">
                            </div>
                            <div class="form-group col-12">
                                <label>Confirm new password</label>
                                <input id="setting-confirm-password" type="password" class="form-control" name="password_confirmation" value="">
                            </div>
                            <div class="form-group col-12">
                                <label>Address</label>
                                <input id="setting-address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Optional Address</label>
                                <input id="setting-optional_address" type="text" class="form-control" name="optional_address" value="{{ Auth::user()->optional_address }}">
                            </div>
                            <div class="form-group col-12">
                                <label>Mobile</label>
                                <input id="setting-mobile" type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block !important">
                        <button id="edit-user" type="submit" class="btn btn-primary btn-block">EDIT USER</button>
                        <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Manage User Ordered Modal !--->
        @endguest
    </div>
</body>
</html>
