<script>
    function showToast(type, message) {
        iziToast[type]({
            title: type,
            message: message,
            position: 'topCenter',
            timeout: 3000,
            progressBar: true,
            displayMode: 'once',
        });
    }
</script>
