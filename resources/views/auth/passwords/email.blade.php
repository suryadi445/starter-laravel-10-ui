@extends('layouts.auth.app')

@section('content')
    <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
            <div class="card-body px-7 py-5 px-md-4">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-2 mx-auto">
                            <p1>Hey There!</p1><br>
                            <p style="color:#245953">Seems As If You Forgot Your Credentials.</p>
                            <p style="color:#245953">We will send a link to your email , use that link.</p>
                            <!-- Email input -->
                            <div class="form-outline mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email Address" @required(true)
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Submit button -->
                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    Sumbit
                                </button>
                            </div>
                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <a href="{{ route('login') }}">
                                    Already Have An Account?
                                </a>
                                <a href="{{ route('register') }}">Don't Have An Account?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
