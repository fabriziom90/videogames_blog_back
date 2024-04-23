@extends('layouts.guest')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-5">Vuoi provare il backoffice? Inviami una mail dalla pagina di contatto del mio
                    sito,
                    specificando chi sei
                    e le motivazioni per cui vuoi provarlo.</h2>
            </div>
            <div class="col-md-8">
                <div class="card bg-primary-color text-white">

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4 row">

                                <div class="col-12">
                                    <label for="email" class="form-label text-md-right">Indirizzo Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">

                                <div class="col-12">
                                    <label for="password" class="form-label text-md-right">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Rimani connesso
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-12 text-center">
                                    <button type="submit" class="secondary-button">
                                        Login
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Hai dimenticato la tua password?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
