<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel 10')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    @vite(['resources/css/auth.css'])

</head>

<body>


    <section class="login">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <p class="my-5 bg-success p-3 rounded" style="color: rgb(255, 255, 255)">
                        Jika anak Adam meninggal, terputuslah amalnya kecuali dari yang tiga; Shedekah jariyah, ilmu
                        yang bermanfaat atau anak saleh yang mendoakan.” (HR. Muslim, no. 1631)
                    </p>
                </div>

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
                                                value="{{ old('email') }}" placeholder="Email Address"
                                                @required(true) autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-around align-items-center mb-4">
                                            <a href="{{ route('login') }}">
                                                Already Have An Account?
                                            </a>
                                            <a href="{{ route('register') }}">Don't Have An Account?</a>
                                        </div>
                                        <!-- Submit button -->
                                        <div class="d-flex justify-content-around align-items-center mb-4">
                                            <button type="submit" class="btn btn-success btn-block">
                                                Sumbit
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
