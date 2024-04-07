<div class="card-body">
    <form id="form-modalAction" class="form"
        action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
        @csrf
        @if ($role->id)
            @method('PUT')
        @endif
        <input type="hidden" name="roleId" id="roleId" value="{{ $role->id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Role</label>
                    <input type="text" placeholder="Input Here" name="name" class="form-control" id="name"
                        value="{{ $role->name }}">
                    <small class="text-danger" id="name-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="guard_name" class="form-label">Guard</label>
                    <input type="text" placeholder="Input Here" name="guard_name" class="form-control"
                        id="guard_name" value="{{ $role->guard_name }}">
                    <small class="text-danger" id="guard_name-error"></small>
                </div>
            </div>
        </div>
    </form>
</div>
