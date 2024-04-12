@php
    // Mendapatkan path dari URL saat ini
    $url = $_SERVER['REQUEST_URI'];

    // Mendapatkan host dari URL saat ini
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

    // Menghilangkan tanda "/" di akhir URL jika ada
    $url = rtrim($url, '/');

    // Mendapatkan path segments dari URL
    $pathSegments = explode('/', trim($url, '/'));

    echo '<nav aria-label="breadcrumb">';
    echo '<ol class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="' . url('/') . '">Home</a></li>';

    $currentPath = '';

    foreach ($pathSegments as $key => $segment) {
        // Membangun URL dinamis dengan host yang disesuaikan
        $currentPath .= '/' . $segment;
        $fullUrl = $currentPath;
        // Menghapus domain "home" dari URL
        $fullUrl = str_replace('home/', '', $fullUrl);
        // Membuat segmen breadcrumb dengan URL dinamis
        echo '<li class="breadcrumb-item"><a href="' . $fullUrl . '">' . ucfirst($segment) . '</a></li>';
    }

    echo '</ol>';
    echo '</nav>';
@endphp
