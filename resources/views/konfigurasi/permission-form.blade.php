<div class="card-body">
    <div class="alert alert-danger d-none" role="alert" id="permissions-error"></div>
    <form id="form-modalAction" class="form" action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="roleId" id="roleId" value="{{ $roleId }}">
        @if (count($permissions) > 0)
            <div class="col-md-3 mb-3">
                <input type="text" id="searchPermission" class="form-control" placeholder="Cari Permission">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label fw-bolder" for="checkAll">Pilih Semua</label>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-4 permission-item">
                    <div class="form-check">
                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                            value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        @if (count($permissions) == 0)
            <div class="alert alert-info" role="alert" id="permissions-error">
                Tidak ada permission yang perlu ditambahkan
            </div>
        @endif
    </form>
</div>
