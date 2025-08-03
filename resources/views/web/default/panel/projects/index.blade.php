@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="section-title mx-0">
                        <h2 class="section-title font-24 text-dark-blue font-weight-bold">{{ trans('panel.projects_list') }}</h2>
                    </div>
                </div>

                @can('panel_organization_projects_create')
                    <div class="d-flex align-items-center">
                        <a href="/panel/projects/new" class="btn btn-primary">{{ trans('panel.create_projects') }}</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</section>
<div class="panel-section-card py-20 px-25 mt-20">
    <form action="/panel/projects/index" method="get" class="row">
        <div class="col-12 col-lg-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">{{ trans('public.from') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="dateInputGroupPrepend">
                                    <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                </span>
                            </div>
                            <input type="text" name="from" autocomplete="off" value="{{ request()->get('from') }}" class="form-control {{ !empty(request()->get('from')) ? 'datepicker' : 'datefilter' }}" aria-describedby="dateInputGroupPrepend"/>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">{{ trans('public.to') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="dateInputGroupPrepend">
                                    <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                </span>
                            </div>
                            <input type="text" name="to" autocomplete="off" value="{{ request()->get('to') }}" class="form-control {{ !empty(request()->get('to')) ? 'datepicker' : 'datefilter' }}" aria-describedby="dateInputGroupPrepend"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="form-group">
                        <label class="input-label">{{ trans('public.search') }}</label>
                        <input type="text" name="search" value="{{ request()->get('search',null) }}" class="form-control"/>
                    </div>
                </div>
                
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label class="input-label d-block">{{ trans('public.status') }}</label>
                        <select name="type" class="form-control">
                            <option >{{ trans('public.all') }}</option>
                            <option value="active" @if(request()->get('type',null) == 'active') selected @endif>{{ trans('public.active') }}</option>
                            <option value="inactive" @if(request()->get('type',null) == 'inactive') selected @endif>{{ trans('public.inactive') }}</option>
                            <option value="verified" @if(request()->get('type',null) == 'verified') selected @endif>{{ trans('public.verified') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">{{ trans('public.show_results') }}</button>
        </div>
    </form>
</div>

    <section>
            <div class="row">
                <div class="col-12">
                    <div class="panel-section-card py-20 px-25 mt-20">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-center font-14">
                                        <thead>
                                            <tr class="text-gray">
                                                <th>{{ trans('public.name') }}</th>
                                                <th>{{ trans('panel.manager') }}</th>
                                                <th>{{ trans('public.start_date') }}</th>
                                                <th>{{ trans('panel.end_date') }}</th>
                                                <th>{{ trans('panel.courses_count') }}</th>
                                                {{-- <th>{{ trans('panel.participants_count') }}</th> --}}
                                                <th>{{ trans('public.status') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($projects->count() > 0)
                                                @foreach($projects as $project)
                                                    <tr>
                                                        <td>{{ $project->name }}</td>
                                                        <td>{{ $project->projectManager->full_name }}</td>
                                                        <td>{{ $project->start_date }}</td>
                                                        <td>{{ $project->end_date }}</td>
                                                        <td>
                                                                {{ $project->webinars->count() ?? 0 }}
                                                           
                                                        </td>
                                                         {{--
                                                        <td>{{ $project->participants_count ?? 0 }}</td> --}}
                                                        <td>
                                                            @if($project->status == 'active')
                                                                <span class="badge badge-primary">{{ trans('public.active') }}</span>
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