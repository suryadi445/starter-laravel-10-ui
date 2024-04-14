@php
    $segments = explode('.', request()->route()->getName());

    // Kode untuk membuat breadcrumb
    echo '<nav aria-label="breadcrumb">';
    echo '<ol class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="/home">Home</a></li>'; // Tambahkan link ke halaman utama di sini
    $breadcrumbUrl = '/';
    $segmentCount = count($segments);
    foreach ($segments as $key => $segment) {
        $breadcrumbUrl .= $segment . '/';
        if ($key == $segmentCount - 1) {
            if ($segment != 'home' && $segment != 'index') {
                // Jika ini adalah segment terakhir, maka breadcrumb menjadi teks tanpa link
                echo '<li class="breadcrumb-item active" aria-current="page">' . ucwords($segment) . '</li>';
            }
        } else {
            // Jika ini bukan segment terakhir, maka tambahkan link
            echo '<li class="breadcrumb-item"><a href="' . $breadcrumbUrl . '">' . ucwords($segment) . '</a></li>';
        }
    }
    echo '</ol>';
    echo '</nav>';
@endphp
