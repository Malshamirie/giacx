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
                            <h2 class="section-title font-24 text-dark-blue font-weight-bold">
                                {{ trans('panel.project_courses') }} - {{ $project->name }}
                            </h2>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="/panel/projects" class="btn btn-outline-primary mr-10">{{ trans('public.back_to_projects') }}</a>
                        @can('panel_organization_projects_edit')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
                                {{ trans('panel.add_course') }}
                            </button>
                        @endcan
                    </div>
                </div>

                <div class="panel-section-card py-20 px-25 mt-20">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table text-center font-14">
                                    <thead>
                                        <tr class="text-gray">
                                            <th>{{ trans('public.title') }}</th>
                                            <th>{{ trans('public.instructor') }}</th>
                                            <th>{{ trans('public.price') }}</th>
                                            <th>{{ trans('public.status') }}</th>
                                            <th>{{ trans('public.created_at') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($project->webinars->count() > 0)
                                            @foreach($project->webinars as $projectWebinar)
                                                @php $webinar = $projectWebinar->webinar; @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="webinar-img mr-15">
                                                                <img src="{{ $webinar->getImage() }}" class="img-cover" alt="{{ $webinar->title }}">
                                                            </div>
                                                            <div class="text-left">
                                                                <h3 class="font-14 text-dark-blue font-weight-bold">{{ $webinar->title }}</h3>
                                                                <p class="font-12 text-gray mt-5">{{ Str::limit($webinar->description, 100) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $webinar->teacher->full_name }}</td>
                                                    <td>
                                                        @if($webinar->price > 0)
                                                            <span class="text-primary font-weight-bold">{{ addCurrencyToPrice($webinar->price) }}</span>
                                                        @else
                                                            <span class="text-success font-weight-bold">{{ trans('public.free') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($webinar->status == 'active')
                                                            <span class="badge badge-primary">{{ trans('public.active') }}</span>
                                                        @elseif($webinar->status == 'pending')
                                                            <span class="badge badge-warning">{{ trans('public.pending') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ trans('public.inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ dateTimeFormat($webinar->created_at, 'j M Y') }}</td>
                                                    <td>
                                                        <div class="btn-group dropdown table-actions">
                                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i data-feather="more-vertical" width="20"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="/panel/webinars/{{ $webinar->id }}/edit" class="webinar-actions d-block mt-10">{{ trans('public.edit') }}</a>
                                                                <a href="/panel/webinars/{{ $webinar->id }}" class="webinar-actions d-block mt-10">{{ trans('public.view') }}</a>
                                                                @can('panel_organization_projects_edit')
                                                                    <a href="#" class="webinar-actions d-block mt-10 text-danger remove-course" data-webinar-id="{{ $webinar->id }}">{{ trans('public.remove_from_project') }}</a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="text-center mt-30">
                                                        <img src="/assets/default/img/404.svg" class="img-fluid" alt="">
                                                        <h3 class="mt-20 font-16 text-gray">{{ trans('panel.no_courses_found') }}</h3>
                                                        @can('panel_organization_projects_edit')
                                                            <button type="button" class="btn btn-primary mt-15" data-toggle="modal" data-target="#addCourseModal">
                                                                {{ trans('panel.add_course') }}
                                                            </button>
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
                </div>
            </div>
        </div>
    </section>

    <!-- Add Course Modal -->
    @can('panel_organization_projects_edit')
        <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCourseModalLabel">{{ trans('panel.add_course_to_project') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/panel/projects/{{ $project->id }}/courses/add" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="input-label">{{ trans('panel.select_course') }}</label>
                                <select name="webinar_id" class="form-control select2" required>
                                    <option value="">{{ trans('panel.select_course') }}</option>
                                    @foreach($availableWebinars as $webinar)
                                        <option value="{{ $webinar->id }}">
                                            {{ $webinar->title }} - {{ $webinar->teacher->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('public.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('panel.add_course') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    
    <script>
        $('.select2').select2();

        $('.remove-course').on('click', function(e) {
            e.preventDefault();
            
            const webinarId = $(this).data('webinar-id');
            
            if (confirm('{{ trans("public.are_you_sure_remove_course") }}')) {
                const form = $('<form>', {
                    'method': 'POST',
                    'action': '/panel/projects/{{ $project->id }}/courses/' + webinarId + '/remove'
                });
                
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));
                
                $('body').append(form);
                form.submit();
            }
        });
    </script>
@endpush 