@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <style>
        .project-overview-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .project-overview-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 20px;
        }
        
        .project-overview-card .card-body {
            padding: 25px;
        }
        
        .stats-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .stats-card:hover {
            transform: translateY(-2px);
        }
        
        .stats-card .card-body {
            padding: 20px;
            text-align: center;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .nav-pills .nav-link {
            border-radius: 25px;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 10px 20px;
            border: none;
            font-weight: 500;
        }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .nav-pills .nav-link:not(.active) {
            background: #f8f9fa;
            color: #6c757d;
        }
        
        .action-buttons .btn {
            border-radius: 25px;
            padding: 10px 20px;
            margin-left: 10px;
        }
        
        .table-custom th {
            background: #f8f9fa;
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .table-custom td {
            padding: 15px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #cce5ff;
            color: #004085;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .course-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid #667eea;
        }
        
        .course-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: conic-gradient(#667eea 0deg, #667eea 87deg, #e9ecef 87deg, #e9ecef 360deg);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .progress-circle::before {
            content: '';
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
        }
        
        .progress-text {
            position: absolute;
            font-size: 0.8rem;
            font-weight: bold;
            color: #667eea;
        }
    </style>
@endpush

@section('content')
<section>
    <h2 class="section-title mb-20">{{ $project->name }}</h2>
</section>

<section>
    <!-- Project Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>{{ trans('panel.project_report') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.improvement_rate_report') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.project_card') }}
                        </a>
                    </div>
                    <button class="btn btn-primary btn-block">{{ trans('panel.export') }}</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
                    <h5 class="mb-0"><i class="fas fa-tools mr-2"></i>{{ trans('panel.project_tools') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/panel/projects/{{ $project->id }}/edit" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.edit_project') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.supervision_team') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.add_note') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);">
                    <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>{{ trans('panel.project_info') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ trans('panel.contract_number') }}:</strong>
                        <span class="text-primary">#{{ $project->id }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.status') }}:</strong>
                        <span class="status-badge status-{{ $project->status }}">
                            {{ trans('panel.status_' . $project->status) }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.landing_page_link') }}:</strong>
                        <a href="#" class="text-primary">{{ $project->slug }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                    <h5 class="mb-0"><i class="fas fa-database mr-2"></i>{{ trans('panel.project_data') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ trans('panel.project_type') }}:</strong>
                        <span class="text-primary">{{ trans('panel.field_' . $project->field) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.start_date') }}:</strong>
                        <span class="text-primary">{{ date('d/m/Y', strtotime($project->start_date)) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.end_date') }}:</strong>
                        <span class="text-primary">{{ date('d/m/Y', strtotime($project->end_date)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-primary">50%</div>
                    <div class="stats-label">{{ trans('panel.general_improvement_rate') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-success">100</div>
                    <div class="stats-label">{{ trans('panel.pre_test_score') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-info">24/30</div>
                    <div class="stats-label">{{ trans('panel.certificate_request_pass_rate') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-warning">34/50</div>
                    <div class="stats-label">{{ trans('panel.post_test_score') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-danger">{{ $project->participants_count ?? 0 }}</div>
                    <div class="stats-label">{{ trans('panel.total_participants') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-purple">{{ $project->webinars_count ?? 0 }}</div>
                    <div class="stats-label">{{ trans('panel.total_courses') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation and Actions -->
    <div class="row mb-4">
        <div class="col-md-8">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#project-logbook" data-toggle="tab">
                        <i class="fas fa-book mr-2"></i>{{ trans('panel.project_logbook') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#candidates" data-toggle="tab">
                        <i class="fas fa-users mr-2"></i>{{ trans('panel.candidates') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#organizational-chart" data-toggle="tab">
                        <i class="fas fa-sitemap mr-2"></i>{{ trans('panel.organizational_chart') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-4 text-right action-buttons">
            <a href="/panel/webinars/new" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>{{ trans('panel.create_new_course') }}
            </a>
           
            
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Project Logbook Tab -->
        <div class="tab-pane fade show active" id="project-logbook">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mt-2 col-md-4 mb-3">
                        <input type="text" class="form-control" placeholder="{{ trans('panel.search') }}">
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>{{ trans('panel.course_name') }}</th>
                                    <th>{{ trans('panel.instructor_name') }}</th>
                                    <th>{{ trans('panel.level') }}</th>
                                    <th>{{ trans('panel.start_date') }}</th>
                                    <th>{{ trans('panel.duration') }}</th>
                                    <th>{{ trans('panel.course_language') }}</th>
                                    <th>{{ trans('panel.status') }}</th>
                                    <th>{{ trans('panel.registered_count') }}</th>
                                    <th>{{ trans('panel.certificate_percentage') }}</th>
                                    <th>{{ trans('panel.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($webinars && $webinars->count() > 0)
                                @foreach($webinars as $webinar)

                                    <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $webinar->getImage() }}" class="course-image mr-3" alt="{{ $webinar->title }}">
                                                    <div>
                                                        <div class="font-weight-bold">{{ $webinar->title }}</div>
                                                        <small class="text-muted">{{ trans('panel.external_course') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $webinar->teacher->full_name ?? '--' }}</td>
                                            <td>-- --</td>
                                            <td>{{  dateTimeFormat($webinar->start_date,'j M Y') }}</td>
                                            <td>{{ convertMinutesToHourAndMinute($webinar->duration) }} Hrs </td>
                                            <td>{{ trans('panel.arabic') }}</td>
                                            <td>
                                                <div class="badges-lists">
                                                    @if(!empty($webinar->deleteRequest) and $webinar->deleteRequest->status == "pending")
                                                        <span class="badge badge-danger">{{ trans('update.removal_request_sent') }}</span>
                                                    @else
                                                        @switch($webinar->status)
                                                            @case(\App\Models\Webinar::$active)
                                                                @if($webinar->isWebinar())
                                                                    @if($webinar->start_date > time())
                                                                        <span class="badge badge-primary">{{  trans('panel.not_conducted') }}</span>
                                                                    @elseif($webinar->isProgressing())
                                                                        <span class="badge badge-secondary">{{ trans('webinars.in_progress') }}</span>
                                                                    @else
                                                                        <span class="badge badge-secondary">{{ trans('public.finished') }}</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-secondary">{{ trans('webinars.'.$webinar->type) }}</span>
                                                                @endif
                                                                @break
                                                            @case(\App\Models\Webinar::$isDraft)
                                                                <span class="badge badge-danger">{{ trans('public.draft') }}</span>
                                                                @break
                                                            @case(\App\Models\Webinar::$pending)
                                                                <span class="badge badge-warning">{{ trans('public.waiting') }}</span>
                                                                @break
                                                            @case(\App\Models\Webinar::$inactive)
                                                                <span class="badge badge-danger">{{ trans('public.rejected') }}</span>
                                                                @break
                                                        @endswitch
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $webinar->students_count ?? 6 }}</td>
                                            <td>
                                                <div class="progress-circle">
                                                    <span class="progress-text">87%</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($webinar->isOwner($authUser->id) or $webinar->isPartnerTeacher($authUser->id))
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" height="20"></i>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        @if(!empty($webinar->start_date))
                                                            <button type="button" data-webinar-id="{{ $webinar->id }}" class="js-webinar-next-session webinar-actions btn-transparent d-block">{{ trans('public.create_join_link') }}</button>
                                                        @endif
        
        
                                                        @can('panel_webinars_learning_page')
                                                            <a href="{{ $webinar->getLearningPageUrl() }}" target="_blank" class="webinar-actions d-block mt-10">{{ trans('update.learning_page') }}</a>
                                                        @endcan
        
                                                        @can('panel_webinars_create')
                                                            <a href="/panel/webinars/{{ $webinar->id }}/edit" class="webinar-actions d-block mt-10">{{ trans('public.edit') }}</a>
                                                        @endcan
        
                                                        @if($webinar->isWebinar())
                                                            @can('panel_webinars_create')
                                                                <a href="/panel/webinars/{{ $webinar->id }}/step/4" class="webinar-actions d-block mt-10">{{ trans('public.sessions') }}</a>
                                                            @endcan
                                                        @endif
        
                                                        @can('panel_webinars_create')
                                                            <a href="/panel/webinars/{{ $webinar->id }}/step/4" class="webinar-actions d-block mt-10">{{ trans('public.files') }}</a>
                                                        @endcan
        
                                                        @can('panel_webinars_export_students_list')
                                                            <a href="/panel/webinars/{{ $webinar->id }}/export-students-list" class="webinar-actions d-block mt-10">{{ trans('public.export_list') }}</a>
                                                        @endcan
        
                                                        @if($authUser->id == $webinar->creator_id)
                                                            @can('panel_webinars_duplicate')
                                                                <a href="/panel/webinars/{{ $webinar->id }}/duplicate" class="webinar-actions d-block mt-10">{{ trans('public.duplicate') }}</a>
                                                            @endcan
                                                        @endif
        
                                                        @can('panel_webinars_statistics')
                                                            <a href="/panel/webinars/{{ $webinar->id }}/statistics" class="webinar-actions d-block mt-10">{{ trans('update.statistics') }}</a>
                                                        @endcan
        
                                                        @if($webinar->creator_id == $authUser->id)
                                                            @can('panel_webinars_delete')
                                                                @include('web.default.panel.includes.content_delete_btn', [
                                                                    'deleteContentUrl' => "/panel/webinars/{$webinar->id}/delete",
                                                                    'deleteContentClassName' => 'webinar-actions d-block mt-10 text-danger',
                                                                    'deleteContentItem' => $webinar,
                                                                    'deleteContentItemType' => "course",
                                                                ])
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>{{ trans('panel.no_courses_found') }}</p>
                                                <a href="/panel/webinars/new" class="btn btn-primary">
                                                    {{ trans('panel.add_course') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Candidates Tab -->
        <div class="tab-pane fade" id="candidates">
            <div class="card">
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ trans('panel.candidates_section') }}</h5>
                        <p class="text-muted">{{ trans('panel.candidates_section_description') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Organizational Chart Tab -->
        <div class="tab-pane fade" id="organizational-chart">
            <div class="card">
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="fas fa-sitemap fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ trans('panel.organizational_chart_section') }}</h5>
                        <p class="text-muted">{{ trans('panel.organizational_chart_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts_bottom')
<script>
$(document).ready(function() {
    // Tab functionality
    $('.nav-pills a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>
@endpush 