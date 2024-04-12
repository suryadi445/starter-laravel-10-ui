<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-override.css') }}">

<section class="container h-100">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="fs-big text-center text-danger fw-bold">404</div>
            <div class="fs-3 text-center fw-bold mb-4">Oops! You are stuck at 404</div>
            <div class="fs-6 text-center mb-3">
                Unfortunately the page you were looking for could not be found.
                It may be temporarily unavailable, moved or no longer exist.
                Check the URL you entered for any mistakes and try again.
            </div>
            <div class="text-center">
                <a href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</section>
