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
                                <table class="table table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-modal id="modalAction" title="Modal title" size="lg"></x-modal>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            // ajax table
            var table = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                "columnDefs": [{
                    "targets": "_all",
                    "className": "text-start"
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // edit
            $('body').on('click', '.editRole', function() {
                var roleId = $(this).data('id');
                $.get("{{ route('roles.index') }}" + '/' + roleId + '/edit', function(response) {
                    $('#modalAction .modal-title').html('Edit Role');
                    $('#form-modalAction').attr('action',
                        `{{ url('konfigurasi/roles') }}/${roleId}`);
                    $('#modalAction .modal-body').html(response);

                    $('#modalAction').modal('show');
                })
            });

            // delete
            $('body').on('click', '.deleteRole', function() {
                var roleId = $(this).data('id');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang di hapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#82868',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('konfigurasi/roles') }}/" + roleId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                table.draw();
                                showToast('success', response.message);
                            },
                            error: function(response) {
                                var errorMessage = response.responseJSON
                                    .message;
                                showToast('error',
                                    errorMessage);
                            }
                        });
                    }
                });
            });

            // save
            $('#save-modal').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var id = $('#roleId').val();

                $.ajax({
                    data: $('#form-modalAction').serialize(),
                    url: `{{ url('konfigurasi/roles/') }}/${id}`,
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        $('#modalAction').modal('hide');
                        table.draw();
                        showToast('success', response.message);
                        $('#save-modal').html('Save');
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(function(key) {
                                var errorMessage = errors[key][0];
                                $('#' + key).siblings('.text-danger').text(
                                    errorMessage);
                            });
                        }
                        $('#save-modal').html('Save');
                    }
                });
            });
        });
    </script>
@endpush
