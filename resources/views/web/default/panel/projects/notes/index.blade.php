@extends('web.default.panel.layouts.panel_layout')

@section('pageTitle', trans('panel.project_notes'))

@section('content')
<div class="page-header d-print-none mb-2">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ trans('panel.project_notes') }} - {{ $project->name }}
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
                        <i class="fas fa-plus"></i>
                        {{ trans('panel.add_note') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('panel.project_notes') }}</h3>
                    </div>
                    <div class="card-body">
                        @if($project->notes->count() > 0)
                            <div class="row">
                                @foreach($project->notes as $note)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <small class="text-muted">{{ $note->created_at_formatted }}</small>
                                                    <div class="btn-group dropdown table-actions">
                                                        <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" width="20"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item edit-note" data-note-id="{{ $note->id }}" data-content="{{ $note->content }}">
                                                                <i class="fas fa-edit mr-2"></i>{{ trans('panel.edit_note') }}
                                                            </a>
                                                            <a href="#" class="dropdown-item delete-note text-danger" data-note-id="{{ $note->id }}">
                                                                <i class="fas fa-trash mr-2"></i>{{ trans('panel.delete_note') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="note-content">
                                                    {{ $note->content }}
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-user mr-1"></i>{{ $note->user->name ?? 'Unknown' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-sticky-note fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">{{ trans('panel.no_notes_found') }}</h5>
                                <p class="text-muted">{{ trans('panel.create_first_note') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('panel.add_note') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="post" action="/panel/projects/notes/{{ $project->id }}/store">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noteContent">{{ trans('panel.note_content') }}</label>
                        <textarea class="form-control" id="noteContent" name="content" rows="4" required placeholder="{{ trans('panel.note_content') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('panel.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('panel.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Note Modal -->
<div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('panel.edit_note') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="post" action="/panel/projects/notes/{{ $project->id }}/{{ $note->id }}/update">
                @csrf
                @method('PUT')
                <input type="hidden" id="editNoteId" name="note_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNoteContent">{{ trans('panel.note_content') }}</label>
                        <textarea class="form-control" id="editNoteContent" name="content" rows="4" required placeholder="{{ trans('panel.note_content') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('panel.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('panel.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts_bottom')
<script>
$(document).ready(function() {
    const projectId = {{ $project->id }};

    // Add Note Form
    $('#addNoteForm').on('submit', function(e) {
        e.preventDefault();
        
        const content = $('#noteContent').val();
        
        $.ajax({
            url: `/panel/projects/notes/${projectId}/store`,
            method: 'POST',
            data: {
                content: content,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#addNoteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                alert('Error: ' + (response?.message || 'Something went wrong'));
            }
        });
    });

    // Edit Note
    $(document).on('click', '.edit-note', function(e) {
        e.preventDefault();
        const noteId = $(this).data('note-id');
        const content = $(this).data('content');
        
        $('#editNoteId').val(noteId);
        $('#editNoteContent').val(content);
        $('#editNoteModal').modal('show');
    });

    // Edit Note Form
    $('#editNoteForm').on('submit', function(e) {
        e.preventDefault();
        
        const noteId = $('#editNoteId').val();
        const content = $('#editNoteContent').val();
        
        $.ajax({
            url: `/panel/projects/notes/${projectId}/${noteId}/update`,
            method: 'PUT',
            data: {
                content: content,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#editNoteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                alert('Error: ' + (response?.message || 'Something went wrong'));
            }
        });
    });

    // Delete Note
    // حذف ملاحظة
    $(document).on('click', '.delete-note', function(e) {
        e.preventDefault();
        const noteId = $(this).data('note-id');
        Swal.fire({
            title: '{{ trans("panel.confirm_action") }}',
            text: '{{ trans("panel.confirm_delete_note") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ trans("public.yes") }}',
            cancelButtonText: '{{ trans("public.cancel") }}',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/panel/projects/notes/${projectId}/${noteId}/destroy`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ trans("panel.success") }}',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: '{{ trans("panel.error") }}',
                            text: '{{ trans("panel.something_went_wrong") }}'
                        });
                    }
                });
            }
        });
    });

    // Clear form when modal is hidden
    $('#addNoteModal').on('hidden.bs.modal', function() {
        $('#addNoteForm')[0].reset();
    });
});
</script>
@endpush