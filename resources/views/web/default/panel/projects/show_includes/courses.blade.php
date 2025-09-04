<div class="tab-pane fade show active" id="project-logbook">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ trans('panel.webinars') }} ({{ $webinars->count() }})</h5>
                <div class="d-flex align-items-center">                    
                    <a href="/panel/webinars/new" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>{{ trans('panel.create_new_course') }}
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-custom ">
                    <thead>
                        <tr>
                            <th>{{ trans('panel.course_name') }}</th>
                            <th>{{ trans('panel.instructor_name') }}</th>
                            <th>{{ trans('panel.category') }}</th>
                            <th>{{ trans('panel.start_date') }}</th>
                            <th>{{ trans('panel.duration') }}</th>
                            <th>{{ trans('panel.price') }}</th>
                            <th>{{ trans('panel.status') }}</th>
                            <th>{{ trans('panel.registered_count') }}</th>
                            <th>{{ trans('panel.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($webinars && $webinars->count() > 0)
                        @foreach($webinars as $webinar)

                            <tr class="text-center">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $webinar->getImage() }}" class="img-cover" alt="">
                                            <div>
                                                <div class="font-weight-bold">{{ $webinar->title }}</div>
                                                <small class="text-muted">{{ trans('panel.external_course') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $webinar->teacher->full_name ?? '--' }}</td>
                                    <td>{{ !empty($webinar->category_id) ? $webinar->category->title : '' }}</td>
                                    <td>{{  dateTimeFormat($webinar->start_date,'j M Y') }}</td>
                                    <td>{{ convertMinutesToHourAndMinute($webinar->duration) }} Hrs </td>
                                    <td>@if($webinar->price > 0)
                                        @if($webinar->bestTicket() < $webinar->price)
                                            <span class="real">{{ handlePrice($webinar->bestTicket(), true, true, false, null, true) }}</span>
                                            <span class="off ml-10">{{ handlePrice($webinar->price, true, true, false, null, true) }}</span>
                                        @else
                                            <span class="real">{{ handlePrice($webinar->price, true, true, false, null, true) }}</span>
                                        @endif
                                    @else
                                        <span class="real">{{ trans('public.free') }}</span>
                                    @endif</td>
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
                                    <td>{{ $webinar->students_count ?? 0 }}</td>
                                    
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