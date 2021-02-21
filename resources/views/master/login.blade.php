<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rocket System V.0.1 @yield('title')</title>
        <link  rel="icon"   href="{{ asset('favicon.png') }}" type="image/favicon" />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        {{-- <link href="{{ asset('css/mdb.min.css')}}" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <!-- SweetAlert -->
        <script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ 'assets/sweetalert2/dist/sweetalert2.min.css' }}">
</head>
<body>

    {{-- <div>
        <main class="pt-5 mx-lg-5">
            <div class="container-fluid mt-5">
                @yield('content')
            </div>
        </main>

    </div> --}}

    <img class="wave" src="{{ asset('img/wave.svg') }}">

	<div class="container">

		<div class="img">
			<img src="{{ asset('img/movile.svg') }}">
		</div>

        <div class="login-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <img src="{{ asset('img/users.png') }}">
                <h2 class="title">Bienvenido.</h2>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input  id="email" type="email" class="input" @error('email')
                                is-invalid @enderror" name="email"
                                value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <h5>Compruebe el campo email</h5>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input  id="password" type="password" class="input"
                                @error('password')
                                is-invalid @enderror" name="password"
                                required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <small>Compruebe el campo email</small>
                    </span>
                    @enderror
                    </div>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Olvide mi contraseña?') }}
                    </a>
                @endif
                <input type="submit" class="btn" value="Iniciar sesion">

            </form>
        </div>

  </div>

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>
