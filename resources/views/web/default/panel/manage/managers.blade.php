@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')


<section>
    <h2 class="section-title">{{ trans('back.managers') }}</h2>

    <div class="activities-container mt-25 p-20 p-lg-35">
        <div class="row">
            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="/assets/default/img/activity/48.svg" width="64" height="64" alt="">
                    <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $users->count() }}</strong>
                    <span class="font-16 text-gray font-weight-500">{{ trans('back.managers') }}</span>
                </div>
            </div>

            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="/assets/default/img/activity/49.svg" width="64" height="64" alt="">
                    <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $activeCount }}</strong>
                    <span class="font-16 text-gray font-weight-500">{{ trans('public.active') }}</span>
                </div>
            </div>

            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="/assets/default/img/activity/60.svg" width="64" height="64" alt="">
                    <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $inActiveCount }}</strong>
                    <span class="font-16 text-gray font-weight-500">{{ trans('public.inactive') }}</span>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="mt-35">
    <h2 class="section-title">{{ trans('back.filter_managers') }}</h2>

    @include('web.default.panel.manage.filters')
</section>
<section class="mt-35">
    <h2 class="section-title">{{ trans('back.managers_list') }}</h2>

        

        <div class="panel-section-card py-20 px-25 mt-20">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                            <tr>
                                <th>{{ trans('public.name') }}</th>
                                <th>{{ trans('public.email') }}</th>
                                <th>{{ trans('public.mobile') }}</th>
                                <th>{{ trans('public.status') }}</th>
                                <th>{{ trans('public.date') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-left">
                                        <div class="user-inline-avatar d-flex align-items-center">
                                            <div class="avatar bg-gray200 rounded-circle">
                                                <img src="{{ $user->getAvatar(40) }}" class="img-cover rounded-circle" alt="">
                                            </div>
                                            <div class=" ml-5">
                                                <span class="d-block text-dark-blue font-weight-500">{{ $user->full_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <span class="text-dark-blue">{{ $user->email }}</span>
                                    </td>
                                    <td class="text-left">
                                        <span class="text-dark-blue">{{ $user->mobile }}</span>
                                    </td>
                                    <td class="text-left">
                                        @if($user->status == 'active')
                                            <span class="text-success">{{ trans('public.active') }}</span>
                                        @else
                                            <span class="text-danger">{{ trans('public.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        <span class="text-dark-blue">{{ dateTimeFormat($user->created_at, 'j M Y') }}</span>
                                    </td>
                                    <td class="text-left">
                                        @can('panel_organization_managers_edit')
                                            <a href="/panel/manage/managers/{{ $user->id }}/edit" class="btn-transparent webinar-actions d-block mt-10">{{ trans('public.edit') }}</a>
                                        @endcan

                                        @can('panel_organization_managers_delete')
                                            <a href="/panel/manage/managers/{{ $user->id }}/delete" class="webinar-actions d-block mt-10 delete-action">{{ trans('public.delete') }}</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-30">
            {{ $users->appends(request()->input())->links('vendor.pagination.panel') }}
        </div>

    </section>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            autoClose: true
        });
    </script>
@endpush 