@extends('layouts.administrator.master')

@section('content')
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold">Roles</h4>
                                @can('create role')
                                    <button type="button" name="Add" class="btn btn-primary btn-sm" id="create">
                                        <i class="ti-plus"></i>
                                        Tambah Data
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-left">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-modal id="modalAction" title="Modal title" size="lg">

        </x-modal>
    </div>
@endsection

@push('js')
    {{ $dataTable->scripts() }}

    <script>
        $(document).on('click', '.action', function() {
            let id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: `{{ url('konfigurasi/roles/') }}/${id}/edit`,
                success: function(response) {
                    $('#modalAction .modal-title').html('Edit Role');
                    $('#form-modalAction').attr('action', `{{ url('konfigurasi/roles') }}/${id}`);
                    $('#modalAction .modal-body').html(response);

                    $('#modalAction').modal('show');

                    handleSubmit();
                }
            });

            function handleSubmit() {
                $('#save-modal').on('click', function(e) {
                    e.preventDefault();
                    var formData = $('#form-modalAction').serialize();

                    $.ajax({
                        type: 'PUT',
                        url: `{{ url('konfigurasi/roles/') }}/${id}`,
                        data: formData,
                        success: function(response) {
                            $('#modalAction').modal('hide');

                            var table = $('#role-table').DataTable();
                            var row = table.row('#' + id);
                            row.data(response.updatedData);
                            table.draw(false);

                            showToast('success', response.message);
                        },
                        error: function(xhr, status, error) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.errors) {
                                Object.keys(response.errors).forEach(function(key) {
                                    var errorMessage = response.errors[key][0];
                                    $('#' + key).siblings('.text-danger').text(
                                        errorMessage);
                                });
                            }
                        }
                    });
                });
            }
        });
    </script>
@endpush
