@extends('layouts.auth.app')

@section('content')
    <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
            <div class="card-body px-7 py-5 px-md-4">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-2 mx-auto">
                            <p1>Welcome!</p1><br>
                            <p style="color:#245953">Please register your correct credentials.</p>

                            <!-- Name input -->
                            <div class="form-outline mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" @required(true) autocomplete="name" autofocus
                                    placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" @required(true) autocomplete="email"
                                    placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <div class="input-group mb-3">
                                    <input id="password" type="password"
                                        class="form-control rounded show-password @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password" @required(true)
                                        autocomplete="new-password">
                                    <span class="input-group-text rounded bg-white ml-1 toggle-password">
                                        <a href="javascript:void(0)" class="text-dark">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- confirm Password  -->
                            <div class="form-outline mb-3">
                                <input id="password-confirm" type="password" class="form-control show-password"
                                    placeholder="Confirm Password" name="password_confirmation" @required(true)
                                    autocomplete="new-password">

                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-around align-items-center mb-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Sign Up
                                </button>
                            </div>

                            <!-- login -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <a href="{{ route('login') }}">Already Have An Account?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
