<div class="row mt-5">
    <div class="col-md-6">
        <button type="button" class="btn btn-secondary" onclick="goBack()">
            <i class="fas fa-undo"></i>
        </button>
        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </div>
</div>

@push('js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endpush
