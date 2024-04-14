@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (performance.navigation.type !== 2) {
                showToast('success', '{{ session('success') }}');
            }
        });
    </script>
@endif
@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (performance.navigation.type !== 2) {
                showToast('error', '{{ session('error') }}');
            }
        });
    </script>
@endif
