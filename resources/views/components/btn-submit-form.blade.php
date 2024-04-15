<div class="row mt-5">
    <div class="col-md-6">
        <button type="button" class="btn btn-secondary" onclick="goBack()">
            <i class="fas fa-undo"></i>
        </button>
        <button type="submit" class="btn btn-primary" id="btn-submit-form">
            Simpan
        </button>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('#btn-submit-form').click(function() {
                var hasRequiredInput = $('input[required], select[required], textarea[required]').filter(
                    function() {
                        return $(this).val().trim() === ''; // Periksa apakah input kosong
                    }).length > 0;

                if (hasRequiredInput) {
                    return;
                }

                $(this).html('Sending..');
                $(this).addClass('disabled');
            })
        });

        function goBack() {
            window.history.back();
        }
    </script>
@endpush
