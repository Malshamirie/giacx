@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="section-title mx-0">
                                <h2 class="section-title font-24 text-dark-blue font-weight-bold">{{ $project->name }}</h2>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            @can('panel_organization_projects_edit')
                                <a href="/panel/projects/{{ $project->id }}/edit" class="btn btn-primary">{{ trans('public.edit') }}</a>
                            @endcan
                            <a href="/panel/projects" class="btn btn-sm btn-gray-200 ml-10">{{ trans('public.back') }}</a>
                        </div>
                    </div>

                    <div class="panel-section-card py-20 px-25 mt-20">
                        <!-- المعلومات الرئيسية -->
                        <div class="row">
                            <div class="col-12">
                                <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.basic_information') }}</h3>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('panel.project_type') }}</label>
                                    <div class="mt-10">
                                        <span class="badge badge-{{ $project->type == 'training' ? 'primary' : ($project->type == 'consultation' ? 'success' : 'warning') }}">
                                            {{ trans('panel.project_type_' . $project->type) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('public.status') }}</label>
                                    <div class="mt-10">
                                        @if($project->status == 'active')
                                            <span class="badge badge-success">{{ trans('public.active') }}</span>
                                        @elseif($project->status == 'completed')
                                            <span class="badge badge-primary">{{ trans('public.completed') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ trans('public.pending') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('public.start_date') }}</label>
                                    <div class="mt-10">
                                        <span>{{ dateTimeFormat($project->start_date, 'j M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('public.end_date') }}</label>
                                    <div class="mt-10">
                                        <span>{{ dateTimeFormat($project->end_date, 'j M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            @if($project->slug)
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label font-weight-bold">{{ trans('panel.landing_page_slug') }}</label>
                                        <div class="mt-10">
                                            <span>{{ $project->slug }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- مدراء المشروع -->
                        <div class="row mt-30">
                            <div class="col-12">
                                <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.project_managers') }}</h3>
                            </div>
                            
                            @if($project->projectManager)
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label font-weight-bold">{{ trans('panel.project_manager') }}</label>
                                        <div class="mt-10">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200 rounded-circle">
                                                    <span class="text-dark-blue font-weight-bold">{{ substr($project->projectManager->full_name, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500">{{ $project->projectManager->full_name }}</span>
                                                    <span class="d-block font-12 text-gray">{{ $project->projectManager->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($project->projectCoordinator)
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label font-weight-bold">{{ trans('panel.project_coordinator') }}</label>
                                        <div class="mt-10">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200 rounded-circle">
                                                    <span class="text-dark-blue font-weight-bold">{{ substr($project->projectCoordinator->full_name, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500">{{ $project->projectCoordinator->full_name }}</span>
                                                    <span class="d-block font-12 text-gray">{{ $project->projectCoordinator->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($project->projectConsultant)
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label font-weight-bold">{{ trans('panel.project_consultant') }}</label>
                                        <div class="mt-10">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200 rounded-circle">
                                                    <span class="text-dark-blue font-weight-bold">{{ substr($project->projectConsultant->full_name, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500">{{ $project->projectConsultant->full_name }}</span>
                                                    <span class="d-block font-12 text-gray">{{ $project->projectConsultant->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- الخدمات -->
                        <div class="row mt-30">
                            <div class="col-12">
                                <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.services') }}</h3>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('panel.project_location') }}</label>
                                    <div class="mt-10">
                                        <span>{{ $project->location }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label font-weight-bold">{{ trans('panel.training_venue') }}</label>
                                    <div class="mt-10">
                                        <span>{{ trans('panel.' . $project->venue_type) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            @if($project->logistics)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label font-weight-bold">{{ trans('panel.logistics_services') }}</label>
                                        <div class="mt-10">
                                            @foreach(json_decode($project->logistics) as $logistic)
                                                <span class="badge badge-info mr-5">{{ trans('panel.' . $logistic) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- تعليمات إضافية -->
                        @if($project->instructions)
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.additional_instructions') }}</h3>
                                    <div class="form-group">
                                        <div class="mt-10">
                                            <p>{{ $project->instructions }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- ملفات المشروع -->
                        <div class="row mt-30">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between mb-20">
                                    <h3 class="font-16 text-dark-blue font-weight-bold">{{ trans('panel.project_files') }}</h3>
                                    @can('panel_organization_projects_edit')
                                        <a href="/panel/projects/{{ $project->id }}/edit" class="btn btn-primary btn-sm">
                                            <i data-feather="edit" width="16" height="16" class="mr-5"></i>
                                            {{ trans('panel.manage_files') }}
                                        </a>
                                    @endcan
                                </div>
                                @if($project->files->count() > 0)
                                    <div class="row">
                                        @foreach($project->files as $file)
                                            <div class="col-12 col-md-6 col-lg-4 mb-20">
                                                <div class="file-card bg-white border border-gray300 rounded-sm p-15">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon mr-15">
                                                            <i data-feather="{{ $file->getIconByType() }}" width="30" height="30" class="text-primary"></i>
                                                        </div>
                                                        <div class="file-info flex-grow-1">
                                                            <h4 class="font-14 text-dark-blue font-weight-bold mb-5">{{ $file->file_name }}</h4>
                                                            <p class="font-12 text-gray mb-5">{{ $file->getFileSize() }}</p>
                                                            <p class="font-12 text-gray">{{ ucfirst($file->file_type) }}</p>
                                                        </div>
                                                        <div class="file-actions">
                                                            <a href="/panel/projects/files/{{ $file->id }}/download" class="btn btn-sm btn-outline-primary">
                                                                <i data-feather="download" width="16" height="16"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-30">
                                        <i data-feather="file" width="50" height="50" class="text-gray"></i>
                                        <h4 class="mt-10 font-16 text-gray">{{ trans('panel.no_files_found') }}</h4>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- الدورات المرتبطة -->
                        <div class="row mt-30">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.courses_count') }} ({{ $project->webinars_count }})</h3>
                                    @can('panel_organization_projects_edit')
                                        <a href="/panel/projects/webinars/{{ $project->id }}" class="btn btn-sm btn-primary">{{ trans('panel.manage_courses') }}</a>
                                    @endcan
                                </div>
                                
                                @if($project->webinars->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table text-center font-14">
                                            <thead>
                                                <tr class="text-gray">
                                                    <th>{{ trans('public.name') }}</th>
                                                    <th>{{ trans('public.instructor') }}</th>
                                                    <th>{{ trans('public.status') }}</th>
                                                    <th>{{ trans('public.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project->webinars as $projectWebinar)
                                                    <tr>
                                                        <td class="text-left">{{ $projectWebinar->webinar->title }}</td>
                                                        <td>{{ $projectWebinar->webinar->teacher->full_name }}</td>
                                                        <td>
                                                            @if($projectWebinar->webinar->status == 'active')
                                                                <span class="badge badge-success">{{ trans('public.active') }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{ trans('public.pending') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="/panel/webinars/{{ $projectWebinar->webinar->id }}/edit" class="btn btn-sm btn-primary">{{ trans('public.view') }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center mt-30">
                                        <p class="text-gray">{{ trans('panel.no_courses_found') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- المشاركين -->
                        <div class="row mt-30">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.participants_count') }} ({{ $project->participants_count }})</h3>
                                    @can('panel_organization_projects_edit')
                                        <a href="/panel/projects/participants/{{ $project->id }}" class="btn btn-sm btn-primary">{{ trans('panel.manage_participants') }}</a>
                                    @endcan
                                </div>
                                
                                @if($project->participants->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table text-center font-14">
                                            <thead>
                                                <tr class="text-gray">
                                                    <th>{{ trans('public.name') }}</th>
                                                    <th>{{ trans('public.email') }}</th>
                                                    <th>{{ trans('public.status') }}</th>
                                                    <th>{{ trans('public.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project->participants as $participant)
                                                    <tr>
                                                        <td class="text-left">
                                                            <div class="user-inline-avatar d-flex align-items-center">
                                                                <div class="avatar bg-gray200 rounded-circle">
                                                                    <span class="text-dark-blue font-weight-bold">{{ substr($participant->user->full_name, 0, 1) }}</span>
                                                                </div>
                                                                <div class="ml-5">
                                                                    <span class="d-block text-dark-blue font-weight-500">{{ $participant->user->full_name }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $participant->user->email }}</td>
                                                        <td>
                                                            @if($participant->status == 'active')
                                                                <span class="badge badge-success">{{ trans('public.active') }}</span>
                                                            @elseif($participant->status == 'completed')
                                                                <span class="badge badge-primary">{{ trans('public.completed') }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{ trans('public.dropped') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="/panel/manage/students/{{ $participant->user->id }}/edit" class="btn btn-sm btn-primary">{{ trans('public.view') }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center mt-30">
                                        <p class="text-gray">{{ trans('panel.no_participants_found') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        $('.delete-action').on('click', function(e) {
            e.preventDefault();
            
            if (confirm('{{ trans("public.are_you_sure_delete") }}')) {
                window.location.href = $(this).attr('href');
            }
        });
    </script>
@endpush 