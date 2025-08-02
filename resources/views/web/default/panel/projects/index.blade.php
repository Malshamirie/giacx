@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="section-title mx-0">
                                <h2 class="section-title font-24 text-dark-blue font-weight-bold">{{ trans('panel.projects') }}</h2>
                            </div>
                        </div>

                        @can('panel_organization_projects_create')
                            <div class="d-flex align-items-center">
                                <a href="/panel/projects/new" class="btn btn-primary">{{ trans('panel.create_projects') }}</a>
                            </div>
                        @endcan
                    </div>

                    <div class="panel-section-card py-20 px-25 mt-20">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-center font-14">
                                        <thead>
                                            <tr class="text-gray">
                                                <th>{{ trans('public.name') }}</th>
                                                <th>{{ trans('public.type') }}</th>
                                                <th>{{ trans('public.start_date') }}</th>
                                                <th>{{ trans('public.end_date') }}</th>
                                                <th>{{ trans('panel.courses_count') }}</th>
                                                <th>{{ trans('panel.participants_count') }}</th>
                                                <th>{{ trans('public.status') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($projects->count() > 0)
                                                @foreach($projects as $project)
                                                    <tr>
                                                        <td class="text-left">
                                                            <div class="user-inline-avatar d-flex align-items-center">
                                                                <div class="avatar bg-gray200 rounded-circle">
                                                                    <span class="text-dark-blue font-weight-bold">{{ substr($project->name, 0, 1) }}</span>
                                                                </div>
                                                                <div class=" ml-5">
                                                                    <span class="d-block text-dark-blue font-weight-500">{{ $project->name }}</span>
                                                                    @if($project->slug)
                                                                        <span class="d-block font-12 text-gray">{{ $project->slug }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-{{ $project->type == 'training' ? 'primary' : ($project->type == 'consultation' ? 'success' : 'warning') }}">
                                                                {{ trans('panel.project_type_' . $project->type) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ dateTimeFormat($project->start_date, 'j M Y') }}</td>
                                                        <td>{{ dateTimeFormat($project->end_date, 'j M Y') }}</td>
                                                        <td>{{ $project->webinars_count ?? 0 }}</td>
                                                        <td>{{ $project->participants_count ?? 0 }}</td>
                                                        <td>
                                                            @if($project->status == 'active')
                                                                <span class="badge badge-success">{{ trans('public.active') }}</span>
                                                            @elseif($project->status == 'completed')
                                                                <span class="badge badge-primary">{{ trans('public.completed') }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{ trans('public.pending') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group dropdown table-actions">
                                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="more-vertical" width="20"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @can('panel_organization_projects_edit')
                                                                        <a href="/panel/projects/{{ $project->id }}/edit" class="webinar-actions d-block mt-10">{{ trans('public.edit') }}</a>
                                                                    @endcan
                                                                    
                                                                    <a href="/panel/projects/{{ $project->id }}/show" class="webinar-actions d-block mt-10">{{ trans('public.view') }}</a>
                                                                    
                                                                    @can('panel_organization_projects_delete')
                                                                        <a href="/panel/projects/{{ $project->id }}/delete" class="webinar-actions d-block mt-10 text-danger delete-action">{{ trans('public.delete') }}</a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <div class="text-center mt-30">
                                                            <img src="/assets/default/img/404.svg" class="img-fluid" alt="">
                                                            <h3 class="mt-20 font-16 text-gray">{{ trans('panel.no_projects_found') }}</h3>
                                                            @can('panel_organization_projects_create')
                                                                <a href="/panel/projects/new" class="btn btn-primary mt-15">{{ trans('panel.create_projects') }}</a>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($projects->count() > 0)
                            <div class="d-flex justify-content-center mt-30">
                                {{ $projects->appends(request()->input())->links('vendor.pagination.panel') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    
    <script>
        $('.delete-action').on('click', function(e) {
            e.preventDefault();
            
            if (confirm('{{ trans("public.are_you_sure_delete") }}')) {
                window.location.href = $(this).attr('href');
            }
        });
    </script>
@endpush 