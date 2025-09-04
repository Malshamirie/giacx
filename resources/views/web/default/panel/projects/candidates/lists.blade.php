@if ($project->candidates->count() > 0)
<div class="table-responsive">
    <table class="table table-custom">
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
                @foreach ($project->candidates as $candidate)
                    <tr class="text-center">
                        <td>
                            <div class="d-flex py-1 align-items-center">
                                <span class="avatar me-2"
                                    style="background-image: url({{ $candidate->user->getAvatar() }})"></span>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">{{ $candidate->user->full_name }}</div>
                                    <div class="text-muted">ID: {{ $candidate->user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $candidate->user->email }}</td>
                        <td>{{ $candidate->user->mobile }}</td>
                        <td>
                            <span class="badge bg-{{ $candidate->status == 'active' ? 'success' : 'danger' }}">
                                {{ $candidate->status_label }}
                            </span>
                        </td>
                        <td>{{ dateTimeFormat($candidate->created_at, 'j M Y | H:i') }}</td>
                        <td>
                            <div class="btn-group dropdown table-actions">
                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical" width="20"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ $candidate->user->getProfileUrl() }}"
                                        class="webinar-actions d-block mt-10" target="_blank">
                                        {{ trans('public.view_profile') }}
                                    </a>
                                    <a href="#" class="webinar-actions d-block mt-10"
                                        onclick="updateCandidateStatus({{ $candidate->id }}, '{{ $candidate->status == 'active' ? 'inactive' : 'active' }}')">
                                        {{ $candidate->status == 'active' ? trans('panel.deactivate') : trans('panel.activate') }}
                                    </a>
                                    <a href="#" class="webinar-actions d-block mt-10 text-danger delete-action"
                                        onclick="deleteCandidate({{ $candidate->id }})">
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
        <h5 class="text-muted">{{ trans('panel.no_candidates_found') }}</h5>
        <p class="text-muted">{{ trans('panel.add_candidates_to_get_started') }}</p>
    </div>
@endif
