@extends('layouts.administrator.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold">{{ $title ?? '' }}</h4>
                @can('create navigation')
                    <button type="button" name="Add" class="btn btn-primary btn-sm" id="createMenu">
                        <i class="ti-plus"></i>
                        Tambah Data
                    </button>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive text-left">
                <table class="table table-bordered dataTable nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Type menu</th>
                            <th>Position</th>
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

    <x-modal id="modalAction" title="Modal title" size="lg"></x-modal>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            // ajax table
            var table = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('navigation.index') }}",
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
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'icon',
                        name: 'icon'
                    },
                    {
                        data: 'main_menu',
                        name: 'main_menu'
                    },
                    {
                        data: 'sort',
                        name: 'sort'
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

            // create
            $('#createMenu').click(function() {
                $.get("{{ route('navigation.create') }}", function(response) {
                    $('#modalAction .modal-title').html('Tambah Menu');
                    $('#modalAction .modal-body').html(response);

                    $('#modalAction').modal('show');
                })
            })

            // edit
            $('body').on('click', '.editRole', function() {
                var roleId = $(this).data('id');
                $.get("{{ route('navigation.index') }}" + '/' + roleId + '/edit', function(response) {
                    $('#modalAction .modal-title').html('Edit Menu');
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
                            url: "{{ url('navigation') }}/" + roleId,
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
                $(this).addClass('disabled');
                var id = $('#navigationId').val();

                $.ajax({
                    data: $('#form-modalAction').serialize(),
                    url: '{{ route('navigation.index') }}' + (id.length ? '/' + id : ''),
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
                        var errors = response.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(function(key) {
                                var errorMessage = errors[key][0];
                                $('#' + key).siblings('.text-danger').text(
                                    errorMessage);
                            });
                        }
                        $('#save-modal').html('Save');
                        $('#save-modal').removeClass('disabled');
                    }
                });
            });


            $(document).on('change', '#type_menu', function() {
                let value = $(this).val()

                if (value == 'child') {
                    $('#main_menu').removeClass('d-none')
                    $('#icon').prop('readonly', true);
                    $('#url').prop('readonly', false)
                    $('#url').val('');
                    $('#icon').val('');
                } else if (value == 'parent') {
                    $('#icon').prop('readonly', false)
                    $('#url').prop('readonly', true)
                    $('#url').val('#');
                    $('#main_menu').addClass('d-none')
                } else {
                    $('#icon').prop('readonly', false)
                    $('#url').prop('readonly', false)
                    $('#url').val('');
                    $('#main_menu').addClass('d-none')
                }
            })

            $(document).on('input', '#name', function() {
                let value = $(this).val()
                let type_menu = $('#type_menu').val()

                if (type_menu == 'parent') {
                    $('#url').val('#');
                }
            })
        });
    </script>
@endpush
