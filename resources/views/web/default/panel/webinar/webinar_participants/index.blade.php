@extends('web.default.panel.layouts.panel_layout')

@section('pageTitle', trans('panel.webinar_participants'))

@push('styles_top')
<link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <div class="page-header d-print-none mb-3">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ trans('lang.webinar_participants') }} - {{ $webinar->title }}
                    </h2>
                    <div class="page-subtitle">
                        {{ trans('panel.project') }}: {{ $project->name }}
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addParticipantsModal">
                            <i class="fas fa-plus"></i>
                            {{ trans('lang.add_participants') }}
                        </button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i>
                        {{ trans('lang.back') }}
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('lang.participants_list') }}</h3>
                </div>
                <div class="card-body">
                    @if($webinar->participants->count() > 0)
                        <div class="table-responsive">
                            <table class="table text-center font-14">
                                <thead>
                                    <tr>
                                        <th>{{ trans('auth.name') }}</th>
                                        <th>{{ trans('auth.email') }}</th>
                                        <th>{{ trans('public.phone') }}</th>
                                        <th>{{ trans('panel.status') }}</th>
                                        <th>{{ trans('public.date') }}</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($webinar->participants as $participant)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2" style="background-image: url({{ $participant->user->getAvatar() }})"></span>
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $participant->user->full_name }}</div>
                                                        <div class="text-muted">ID: {{ $participant->user->id }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $participant->user->email }}</td>
                                            <td>{{ $participant->user->mobile }}</td>
                                            <td>
                                                <span class="badge bg-{{ $participant->status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ $participant->status_label }}
                                                </span>
                                            </td>
                                            <td>{{ dateTimeFormat($participant->created_at, 'j M Y | H:i') }}</td>
                                            <td>
                                                <div class="dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" width="20"></i>
                                                    </button>                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ $participant->user->getProfileUrl() }}" target="_blank">
                                                                <i class="fas fa-eye me-2"></i>
                                                                {{ trans('public.view_profile') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" onclick="updateParticipantStatus({{ $participant->id }}, '{{ $participant->status == 'active' ? 'inactive' : 'active' }}')">
                                                                <i class="fas fa-toggle-{{ $participant->status == 'active' ? 'off' : 'on' }} me-2"></i>
                                                                {{ $participant->status == 'active' ? trans('panel.deactivate') : trans('panel.activate') }}
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteParticipant({{ $participant->id }})">
                                                                <i class="fas fa-trash me-2"></i>
                                                                {{ trans('public.delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">{{ trans('lang.no_participants_found') }}</h5>
                            <p class="text-muted">{{ trans('lang.add_participants_to_get_started') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal إضافة المشاركين -->
    <div class="modal fade" id="addParticipantsModal" tabindex="-1" role="dialog" aria-labelledby="addParticipantsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addParticipantsModalLabel">{{ trans('lang.add_participants') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addParticipantsForm">
                    @csrf
                    <input type="hidden" name="webinar_id" value="{{ $webinar->id }}">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-label d-block">{{ trans('lang.select_students') }}</label>
                            <select name="student_ids[]" class="form-control select2" multiple="multiple" data-placeholder="{{ trans('lang.search_and_select_students') }}">
                                @php
                                    // جلب الطالبين التابعين للمشروع
                                    $projectstudents = $project->students()
                                        ->whereNotIn('user_id', $webinar->participants->pluck('user_id'))
                                        ->with('user')
                                        ->get();
                                @endphp
                                
                                @foreach($projectstudents as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->user->full_name }} ({{ $student->user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('public.close') }}</button>
                        <button type="submit" class="btn btn-primary" id="saveParticipantsBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            {{ trans('public.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
<script src="/assets/default/vendors/select2/select2.min.js"></script>
<script>
$(document).ready(function() {
    // تفعيل Select2
    $('.select2').select2({
        placeholder: '{{ trans("lang.search_and_select_students") }}',
        allowClear: true,
        width: '100%'
    });

    // إرسال النموذج عبر AJAX
    $('#addParticipantsForm').on('submit', function(e) {
        e.preventDefault();
        
        let $form = $(this);
        let $submitBtn = $('#saveParticipantsBtn');
        let $spinner = $submitBtn.find('.spinner-border');
        let formData = $form.serialize();
        
        // إظهار حالة التحميل
        $submitBtn.prop('disabled', true);
        $spinner.removeClass('d-none');
        
        // إزالة رسائل الخطأ السابقة
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').text('');
        
        $.ajax({
            url: '{{ route("panel.webinar.participants.store", $webinar->id) }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.code === 200) {
                    // إظهار رسالة النجاح
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("panel.success") }}',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    // إغلاق المودل وتحديث الصفحة
                    $('#addParticipantsModal').modal('hide');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON;
                if (errors && errors.errors) {
                    // عرض أخطاء التحقق
                    Object.keys(errors.errors).forEach(function(key) {
                        let error = errors.errors[key];
                        let element = $form.find('[name="' + key + '"]');
                        element.addClass('is-invalid');
                        element.parent().find('.invalid-feedback').text(error[0]);
                    });
                } else {
                    // رسالة خطأ عامة
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            },
            complete: function() {
                // إعادة تفعيل الزر
                $submitBtn.prop('disabled', false);
                $spinner.addClass('d-none');
            }
        });
    });
});

// تحديث حالة المشارك
function updateParticipantStatus(participantId, newStatus) {
    Swal.fire({
        title: '{{ trans("panel.confirm_action") }}',
        text: '{{ trans("panel.are_you_sure_update_status") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.webinar.participants.update", ["webinar_id" => $webinar->id, "participant_id" => ":participant_id"]) }}'.replace(':participant_id', participantId),
                type: 'PUT',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
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
}

// حذف مشارك
function deleteParticipant(participantId) {
    Swal.fire({
        title: '{{ trans("panel.confirm_action") }}',
        text: '{{ trans("lang.are_you_sure_delete") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.webinar.participants.destroy", ["webinar_id" => $webinar->id, "participant_id" => ":participant_id"]) }}'.replace(':participant_id', participantId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
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
}
</script>
@endpush
