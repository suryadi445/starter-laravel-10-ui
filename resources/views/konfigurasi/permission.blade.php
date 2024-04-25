@extends('layouts.administrator.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold">{{ $title ?? '' }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive text-left">
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-modal id="modalAction" title="Modal title" size="xl modal-dialog-scrollable"></x-modal>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            // ajax table
            var table = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
                columnDefs: [{
                    "targets": "_all",
                    "className": "text-start"
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // edit
            $('body').on('click', '.editRole', function() {
                var roleId = $(this).data('id');
                $.get("{{ route('permissions.index') }}" + '/' + roleId + '/edit', function(response) {
                    $('#modalAction .modal-title').html('Tambah Permission');
                    $('#modalAction .modal-body').html(response);

                    $('#modalAction').modal('show');
                })
            });

            // delete
            $(document).on('click', '.delete-permission', function(e) {
                var permissionId = $(this).data('permission-id');
                var roleId = $(this).data('role-id');

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
                            url: "{{ url('permissions') }}/" + permissionId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                role_id: roleId
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

            // select all
            $(document).on('change', '#checkAll', function() {
                var isChecked = $(this).prop('checked');

                if (isChecked) {
                    $('.permission-item:visible .permission-checkbox').prop('checked', true);
                } else {
                    $('.permission-checkbox').prop('checked', false);
                }
            });

            // search permission
            $(document).on('input', '#searchPermission', function() {
                var searchValue = $(this).val().toLowerCase();
                var permissionItems = $('.permission-item');
                var showSelectAll = false;

                permissionItems.each(function() {
                    var label = $(this).find('.form-check-label');
                    var permissionName = label.text().toLowerCase();

                    if (permissionName.includes(searchValue)) {
                        $(this).show();
                        showSelectAll = true;
                    } else {
                        $(this).hide();
                    }
                });

                var selectAllCheckbox = $('#checkAll');
                if (selectAllCheckbox.length > 0) {
                    selectAllCheckbox.closest('.row').css('display', showSelectAll ? 'block' : 'none');
                }
            });


            $('#save-modal').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $(this).addClass('disabled');

                $.ajax({
                    data: $('#form-modalAction').serialize(),
                    url: `{{ route('permissions.store') }}`,
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        $('#modalAction').modal('hide');
                        table.draw();
                        if (response.status == true) {
                            showToast('success', response.message);
                        } else {
                            showToast('error', response.message);
                        }
                        $('#save-modal').html('Save');
                        $('#save-modal').removeClass('disabled');
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            var errors = response.responseJSON.errors;
                            if (errors.hasOwnProperty('permissions')) {
                                var errorMessage = errors['permissions'][0];
                                $('#permissions-error').removeClass('d-none');
                                $('#permissions-error').text(errorMessage);
                            }
                        }

                        $('#save-modal').html('Save');
                        $('#save-modal').removeClass('disabled');
                    }
                });
            });

        });
    </script>
@endpush
