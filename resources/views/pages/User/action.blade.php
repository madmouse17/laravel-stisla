@if (!$query->deleted_at)

    <button type="button" id="reset" class="btn btn-warning" data-id="{{ $query->id }}"><i
            class="fas fa-key"></i></button>
    <a href="{{ route('admin.edit', $query->id) }}" data-id="{{ $query->id }}" class="btn btn-primary"><i
            class="fas fa-highlighter"></i></a>
            @if (Session::has('edit-admin'))
            @if (Session::get('edit-admin') != $query->id)
            <a href="#" data-id="{{ $query->id }}" class="btn btn-danger" id="hapus"><i
                class="fas fa-trash"></i></a>
            @endif
        @else
        <a href="#" data-id="{{ $query->id }}" class="btn btn-danger" id="hapus"><i
            class="fas fa-trash"></i></a>
        @endif

@else
    <a href="#" data-id="{{ $query->id }}" class="btn btn-info" id="restore">
        <i class="fas fa-recycle"></i>
    </a>
@endif
