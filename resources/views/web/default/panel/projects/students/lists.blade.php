@if ($students->count() > 0)
<!-- شريط العمليات الجماعية -->
<div class="bulk-actions-bar mb-3" id="bulkActionsBar" style="display: none;">
    <div class="d-flex align-items-center">
        <span class="me-3 text-muted" id="selectedCount">0 {{ trans('panel.selected') }}</span>
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="bulkConvertType('participant')">
                <i class="fas fa-user-check"></i> {{ trans('panel.convert_to_participant') }}
            </button>
            <button type="button" class="btn btn-sm btn-outline-warning" onclick="bulkConvertType('candidate')">
                <i class="fas fa-user-clock"></i> {{ trans('panel.convert_to_candidate') }}
            </button>
        </div>
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-success" onclick="bulkUpdateStatus('active')">
                <i class="fas fa-check"></i> {{ trans('panel.activate') }}
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkUpdateStatus('inactive')">
                <i class="fas fa-times"></i> {{ trans('panel.deactivate') }}
            </button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkDelete()">
            <i class="fas fa-trash"></i> {{ trans('public.delete') }}
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearSelection()">
            <i class="fas fa-times"></i> {{ trans('panel.clear_selection') }}
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th class="w-1">
                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                </th>
                <th>{{ trans('auth.name') }}</th>
                <th>{{ trans('auth.email') }}</th>
                <th>{{ trans('public.phone') }}</th>
                <th>{{ trans('panel.status') }}</th>
                <th>{{ trans('panel.type') }}</th>
                <th>{{ trans('public.date') }}</th>
                <th class="w-1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="text-center">
                    <td>
                        <input type="checkbox" class="student-checkbox" value="{{ $student->id }}" onchange="updateBulkActions()">
                    </td>
                    <td>
                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2"
                                style="background-image: url({{ $student->user->getAvatar() }})"></span>
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ $student->user->full_name }}</div>
                                <div class="text-muted">ID: {{ $student->user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->user->mobile }}</td>
                    <td>
                        <span class="badge bg-{{ $student->status == 'active' ? 'success' : 'danger' }}">
                            {{ $student->status_label }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $student->type == 'participant' ? 'primary' : 'warning' }}">
                            {{ $student->type_label }}
                        </span>
                    </td>
                    <td>{{ dateTimeFormat($student->created_at, 'j M Y | H:i') }}</td>
                    <td>
                        <div class="btn-group dropdown table-actions">
                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical" width="20"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ $student->user->getProfileUrl() }}"
                                    class="webinar-actions d-block mt-10" target="_blank">
                                    {{ trans('public.view_profile') }}
                                </a>
                                @if($student->type == 'participant')
                                <a href="#" class="webinar-actions d-block mt-10"
                                    onclick="convertType({{ $student->id }}, 'candidate')">
                                    {{ trans('panel.convert_to_candidate') }}
                                </a>
                                @elseif($student->type == 'candidate')
                                <a href="#" class="webinar-actions d-block mt-10"
                                    onclick="convertType({{ $student->id }}, 'participant')">
                                    {{ trans('panel.convert_to_participant') }}
                                </a>
                                @endif
                                <a href="#" class="webinar-actions d-block mt-10"
                                    onclick="updatestudentstatus({{ $student->id }}, '{{ $student->status == 'active' ? 'inactive' : 'active' }}')">
                                    {{ $student->status == 'active' ? trans('panel.deactivate') : trans('panel.activate') }}
                                </a>
                                <a href="#" class="webinar-actions d-block mt-10 text-danger delete-action"
                                    onclick="deletestudent({{ $student->id }})">
                                    {{ trans('public.delete') }}
                                </a>
                            </div>
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
        <h5 class="text-muted">{{ trans('panel.no_students_found') }}</h5>
        <p class="text-muted">{{ trans('panel.add_students_to_get_started') }}</p>
    </div>
@endif

