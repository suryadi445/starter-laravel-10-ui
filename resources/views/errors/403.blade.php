<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-override.css') }}">


<section class="container h-100">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="fs-big text-center text-danger fw-bold">403</div>
            <div class="fs-3 text-center fw-bold mb-4">Forbidden</div>
            <div class="fs-6 text-center mb-3">
                You don't have access to this page.
            </div>
            <div class="text-center">
                <a href="{{ url()->previous() }}">Back</a>

            </div>
        </div>
    </div>
</section>
