<div class="card-body">
    <form id="form-modalAction" class="form"
        action="{{ $navigation->id ? route('navigation.update', $navigation->id) : route('navigation.store') }}"
        method="POST">
        @csrf
        @if ($navigation->id)
            @method('PUT')
        @endif
        <input type="hidden" name="navigationId" id="navigationId" value="{{ $navigation->id }}">
        <div class="row">
            <div class="col-md-6">
                <label for="menu" class="form-label">Menu</label>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="menu" id="menu1" value="child"
                            {{ $navigation->main_menu == 1 || empty($navigation->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="menu1">
                            Child Menu
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="menu" id="menu2" value="parent"
                            {{ $navigation->main_menu == null && $navigation->id ? 'checked' : '' }}>
                        <label class="form-check-label" for="menu2">
                            Parent Menu
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 {{ $navigation->main_menu == null && $navigation->id ? 'd-none' : '' }}"
                id="main_menu">
                <div class="mb-3">
                    <label for="main_menu" class="form-label">Parent Menu</label>
                    <select class="form-select select2" name="main_menu" id="main_menu"
                        aria-label="Default select example">
                        <option value="" selected>Open this select menu</option>
                        @foreach ($parent as $item)
                            <option {{ $navigation->main_menu == $item->id ? 'selected' : '' }}
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" placeholder="Input Here" name="name" class="form-control" id="name"
                        value="{{ $navigation->name }}">
                    <small class="text-danger" id="name-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" placeholder="Input Here" name="url" class="form-control" id="url"
                        value="{{ $navigation->url }}">
                    <small class="text-danger" id="url-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" placeholder="Input Here" name="icon" class="form-control" id="icon"
                        value="{{ $navigation->icon }}">
                    <small class="text-danger" id="icon-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sort" class="form-label">Position</label>
                    <input type="text" placeholder="Input Here" name="sort" class="form-control" id="sort"
                        value="{{ $navigation->sort ?? '0' }}">
                    <small class="text-danger" id="sort-error"></small>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select an option',
            dropdownParent: $("#modalAction")
        });
    })
</script>
