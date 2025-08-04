@php
    $getPanelSidebarSettings = getPanelSidebarSettings();
@endphp

<div class="xs-panel-nav d-flex d-lg-none justify-content-between py-5 px-15">
    <div class="user-info d-flex align-items-center justify-content-between">
        <div class="user-avatar bg-gray200">
            <img src="{{ $authUser->getAvatar(100) }}" class="img-cover" alt="{{ $authUser->full_name }}">
        </div>

        <div class="user-name ml-15">
            <h3 class="font-16 font-weight-bold">{{ $authUser->full_name }}</h3>
        </div>
    </div>

    <button class="sidebar-toggler btn-transparent d-flex flex-column-reverse justify-content-center align-items-center p-5 rounded-sm sidebarNavToggle" type="button">
        <span>{{ trans('navbar.menu') }}</span>
        <i data-feather="menu" width="16" height="16"></i>
    </button>
</div>

<div class="panel-sidebar pt-50 pb-25 px-25" id="panelSidebar">
    <button class="btn-transparent panel-sidebar-close sidebarNavToggle">
        <i data-feather="x" width="24" height="24"></i>
    </button>

    <div class="user-info d-flex align-items-center flex-row flex-lg-column justify-content-lg-center">
        <a href="/panel" class="user-avatar bg-gray200">
            <img src="{{ $authUser->getAvatar(100) }}" class="img-cover" alt="{{ $authUser->full_name }}">
        </a>

        <div class="d-flex flex-column align-items-center justify-content-center">
            <a href="/panel" class="user-name mt-15">
                <h3 class="font-16 font-weight-bold text-center">{{ $authUser->full_name }}</h3>
            </a>

            @if(!empty($authUser->getUserGroup()))
                <span class="create-new-user mt-10">{{ $authUser->getUserGroup()->name }}</span>
            @endif
        </div>
    </div>

    <div class="d-flex sidebar-user-stats pb-10 ml-20 pb-lg-20 mt-15 mt-lg-30">
        <div class="sidebar-user-stat-item d-flex flex-column">
            <strong class="text-center">{{ $authUser->webinars()->count() }}</strong>
            <span class="font-12">{{ trans('panel.classes') }}</span>
        </div>

        <div class="border-left mx-30"></div>

        @if($authUser->isUser())
            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center">{{ $authUser->following()->count() }}</strong>
                <span class="font-12">{{ trans('panel.following') }}</span>
            </div>
        @else
            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center">{{ $authUser->followers()->count() }}</strong>
                <span class="font-12">{{ trans('panel.followers') }}</span>
            </div>
        @endif
    </div>

    <ul id="panel-sidebar-scroll" class="sidebar-menu pt-10 @if(!empty($authUser->userGroup)) has-user-group @endif @if(empty($getPanelSidebarSettings) or empty($getPanelSidebarSettings['background'])) without-bottom-image @endif" @if((!empty($isRtl) and $isRtl)) data-simplebar-direction="rtl" @endif>

        {{-- Dashboard --}}
        <li class="sidenav-item {{ (request()->is('panel')) ? 'sidenav-item-active' : '' }}">
            <a href="/panel" class="d-flex align-items-center">
                <span class="sidenav-item-icon mr-10">
                    @include('web.default.panel.includes.sidebar_icons.dashboard')
                </span>
                <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.dashboard') }}</span>
            </a>
        </li>

        {{-- Projects --}}
        @can('panel_organization_projects')
            <li class="sidenav-item {{ (request()->is('panel/projects') or request()->is('panel/projects/*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#projectsCollapse" role="button" aria-expanded="false" aria-controls="projectsCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 2L2 9L9 16L16 9L9 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 6L14 11L9 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 6L4 11L9 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.projects') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/projects') or request()->is('panel/projects/*')) ? 'show' : '' }}" id="projectsCollapse">
                    <ul class="sidenav-item-collapse">
                        @can('panel_organization_projects_create')
                            <li class="mt-5 {{ (request()->is('panel/projects/new')) ? 'active' : '' }}">
                                <a href="/panel/projects/new">{{ trans('public.new') }}</a>
                            </li>
                        @endcan
                        @can('panel_organization_projects_lists')
                            <li class="mt-5 {{ (request()->is('panel/projects')) ? 'active' : '' }}">
                                <a href="/panel/projects">{{ trans('public.list') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Managers --}}
        @can('panel_organization_managers')
            <li class="sidenav-item {{ (request()->is('panel/managers') or request()->is('panel/manage/managers*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#managersCollapse" role="button" aria-expanded="false" aria-controls="managersCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <i data-feather="users" class="img-cover"></i>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.managers') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/managers') or request()->is('panel/manage/managers*')) ? 'show' : '' }}" id="managersCollapse">
                    <ul class="sidenav-item-collapse">
                        @can('panel_organization_managers_create')
                            <li class="mt-5 {{ (request()->is('panel/managers/new')) ? 'active' : '' }}">
                                <a href="/panel/manage/managers/new">{{ trans('public.new') }}</a>
                            </li>
                        @endcan
                        @can('panel_organization_managers_lists')
                            <li class="mt-5 {{ (request()->is('panel/manage/managers')) ? 'active' : '' }}">
                                <a href="/panel/manage/managers">{{ trans('public.list') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Students --}}
        @can('panel_organization_students')
            <li class="sidenav-item {{ (request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#studentsCollapse" role="button" aria-expanded="false" aria-controls="studentsCollapse">
                    <span class="sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.students')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('quiz.students') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'show' : '' }}" id="studentsCollapse">
                    <ul class="sidenav-item-collapse">
                        @can('panel_organization_students_create')
                            <li class="mt-5 {{ (request()->is('panel/manage/students/new')) ? 'active' : '' }}">
                                <a href="/panel/manage/students/new">{{ trans('public.new') }}</a>
                            </li>
                        @endcan
                        @can('panel_organization_students_lists')
                            <li class="mt-5 {{ (request()->is('panel/manage/students')) ? 'active' : '' }}">
                                <a href="/panel/manage/students">{{ trans('public.list') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Instructors --}}
        @can('panel_organization_instructors')
            <li class="sidenav-item {{ (request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#instructorsCollapse" role="button" aria-expanded="false" aria-controls="instructorsCollapse">
                    <span class="sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.teachers')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('public.instructors') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'show' : '' }}" id="instructorsCollapse">
                    <ul class="sidenav-item-collapse">
                        @can('panel_organization_instructors_create')
                            <li class="mt-5 {{ (request()->is('panel/instructors/new')) ? 'active' : '' }}">
                                <a href="/panel/manage/instructors/new">{{ trans('public.new') }}</a>
                            </li>
                        @endcan
                        @can('panel_organization_instructors_lists')
                            <li class="mt-5 {{ (request()->is('panel/manage/instructors')) ? 'active' : '' }}">
                                <a href="/panel/manage/instructors">{{ trans('public.list') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Courses --}}
        @can('panel_webinars')
            <li class="sidenav-item {{ (request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#webinarCollapse" role="button" aria-expanded="false" aria-controls="webinarCollapse">
                    <span class="sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.webinars')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.webinars') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'show' : '' }}" id="webinarCollapse">
                    <ul class="sidenav-item-collapse">
                        @if($authUser->isOrganization() || $authUser->isTeacher())
                            @can('panel_webinars_create')
                                <li class="mt-5 {{ (request()->is('panel/webinars/new')) ? 'active' : '' }}">
                                    <a href="/panel/webinars/new">{{ trans('public.new') }}</a>
                                </li>
                            @endcan
                            @can('panel_webinars_lists')
                                <li class="mt-5 {{ (request()->is('panel/webinars')) ? 'active' : '' }}">
                                    <a href="/panel/webinars">{{ trans('panel.my_classes') }}</a>
                                </li>
                            @endcan
                            @can('panel_webinars_invited_lists')
                                <li class="mt-5 {{ (request()->is('panel/webinars/invitations')) ? 'active' : '' }}">
                                    <a href="/panel/webinars/invitations">{{ trans('panel.invited_classes') }}</a>
                                </li>
                            @endcan
                        @endif
                        @if(!empty($authUser->organ_id))
                            @can('panel_webinars_organization_classes')
                                <li class="mt-5 {{ (request()->is('panel/webinars/organization_classes')) ? 'active' : '' }}">
                                    <a href="/panel/webinars/organization_classes">{{ trans('panel.organization_classes') }}</a>
                                </li>
                            @endcan
                        @endif
                        @can('panel_webinars_my_purchases')
                            <li class="mt-5 {{ (request()->is('panel/webinars/purchases')) ? 'active' : '' }}">
                                <a href="/panel/webinars/purchases">{{ trans('panel.my_purchases') }}</a>
                            </li>
                        @endcan
                        @if($authUser->isOrganization() || $authUser->isTeacher())
                            @can('panel_webinars_my_class_comments')
                                <li class="mt-5 {{ (request()->is('panel/webinars/comments')) ? 'active' : '' }}">
                                    <a href="/panel/webinars/comments">{{ trans('panel.my_class_comments') }}</a>
                                </li>
                            @endcan
                        @endif
                        @can('panel_webinars_comments')
                            <li class="mt-5 {{ (request()->is('panel/webinars/my-comments')) ? 'active' : '' }}">
                                <a href="/panel/webinars/my-comments">{{ trans('panel.my_comments') }}</a>
                            </li>
                        @endcan
                        @can('panel_webinars_favorites')
                            <li class="mt-5 {{ (request()->is('panel/webinars/favorites')) ? 'active' : '' }}">
                                <a href="/panel/webinars/favorites">{{ trans('panel.favorites') }}</a>
                            </li>
                        @endcan
                        @if(!empty(getFeaturesSettings('course_notes_status')))
                            @can('panel_webinars_personal_course_notes')
                                <li class="mt-5 {{ (request()->is('panel/webinars/personal-notes')) ? 'active' : '' }}">
                                    <a href="/panel/webinars/personal-notes">{{ trans('update.course_notes') }}</a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Quizzes --}}
        @can('panel_quizzes')
            <li class="sidenav-item {{ (request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#quizzesCollapse" role="button" aria-expanded="false" aria-controls="quizzesCollapse">
                    <span class="sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.quizzes')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.quizzes') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'show' : '' }}" id="quizzesCollapse">
                    <ul class="sidenav-item-collapse">
                        @if($authUser->isOrganization() || $authUser->isTeacher())
                            @can('panel_quizzes_create')
                                <li class="mt-5 {{ (request()->is('panel/quizzes/new')) ? 'active' : '' }}">
                                    <a href="/panel/quizzes/new">{{ trans('quiz.new_quiz') }}</a>
                                </li>
                            @endcan
                            @can('panel_quizzes_lists')
                                <li class="mt-5 {{ (request()->is('panel/quizzes')) ? 'active' : '' }}">
                                    <a href="/panel/quizzes">{{ trans('public.list') }}</a>
                                </li>
                            @endcan
                            @can('panel_quizzes_results')
                                <li class="mt-5 {{ (request()->is('panel/quizzes/results')) ? 'active' : '' }}">
                                    <a href="/panel/quizzes/results">{{ trans('public.results') }}</a>
                                </li>
                            @endcan
                        @endif
                        @can('panel_quizzes_my_results')
                            <li class="mt-5 {{ (request()->is('panel/quizzes/my-results')) ? 'active' : '' }}">
                                <a href="/panel/quizzes/my-results">{{ trans('public.my_results') }}</a>
                            </li>
                        @endcan
                        @can('panel_quizzes_not_participated')
                            <li class="mt-5 {{ (request()->is('panel/quizzes/opens')) ? 'active' : '' }}">
                                <a href="/panel/quizzes/opens">{{ trans('public.not_participated') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Support --}}
        @can('panel_support')
            <li class="sidenav-item {{ (request()->is('panel/support') or request()->is('panel/support/*')) ? 'sidenav-item-active' : '' }}">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#supportCollapse" role="button" aria-expanded="false" aria-controls="supportCollapse">
                    <span class="sidenav-item-icon assign-fill mr-10">
                        @include('web.default.panel.includes.sidebar_icons.support')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.support') }}</span>
                </a>
                <div class="collapse {{ (request()->is('panel/support') or request()->is('panel/support/*')) ? 'show' : '' }}" id="supportCollapse">
                    <ul class="sidenav-item-collapse">
                        @can('panel_support_create')
                            <li class="mt-5 {{ (request()->is('panel/support/new')) ? 'active' : '' }}">
                                <a href="/panel/support/new">{{ trans('public.new') }}</a>
                            </li>
                        @endcan
                        @can('panel_support_lists')
                            <li class="mt-5 {{ (request()->is('panel/support')) ? 'active' : '' }}">
                                <a href="/panel/support">{{ trans('panel.classes_support') }}</a>
                            </li>
                        @endcan
                        @can('panel_support_tickets')
                            <li class="mt-5 {{ (request()->is('panel/support/tickets')) ? 'active' : '' }}">
                                <a href="/panel/support/tickets">{{ trans('panel.support_tickets') }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        {{-- Noticeboard --}}
        @if($authUser->isOrganization() || $authUser->isTeacher())
            @can('panel_noticeboard')
                <li class="sidenav-item {{ (request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'sidenav-item-active' : '' }}">
                    <a class="d-flex align-items-center" data-toggle="collapse" href="#noticeboardCollapse" role="button" aria-expanded="false" aria-controls="noticeboardCollapse">
                        <span class="sidenav-item-icon mr-10">
                            @include('web.default.panel.includes.sidebar_icons.noticeboard')
                        </span>
                        <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.noticeboard') }}</span>
                    </a>
                    <div class="collapse {{ (request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'show' : '' }}" id="noticeboardCollapse">
                        <ul class="sidenav-item-collapse">
                            @can('panel_noticeboard_history')
                                <li class="mt-5 {{ (request()->is('panel/noticeboard')) ? 'active' : '' }}">
                                    <a href="/panel/noticeboard">{{ trans('public.history') }}</a>
                                </li>
                            @endcan
                            @can('panel_noticeboard_create')
                                <li class="mt-5 {{ (request()->is('panel/noticeboard/new')) ? 'active' : '' }}">
                                    <a href="/panel/noticeboard/new">{{ trans('public.new') }}</a>
                                </li>
                            @endcan
                            @can('panel_noticeboard_course_notices')
                                <li class="mt-5 {{ (request()->is('panel/course-noticeboard')) ? 'active' : '' }}">
                                    <a href="/panel/course-noticeboard">{{ trans('update.course_notices') }}</a>
                                </li>
                            @endcan
                            @can('panel_noticeboard_course_notices_create')
                                <li class="mt-5 {{ (request()->is('panel/course-noticeboard/new')) ? 'active' : '' }}">
                                    <a href="/panel/course-noticeboard/new">{{ trans('update.new_course_notices') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
        @endif

        {{-- Notifications --}}
        @can('panel_notifications')
            <li class="sidenav-item {{ (request()->is('panel/notifications')) ? 'sidenav-item-active' : '' }}">
                <a href="/panel/notifications" class="d-flex align-items-center">
                    <span class="sidenav-notification-icon sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.notifications')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.notifications') }}</span>
                </a>
            </li>
        @endcan

        {{-- Settings --}}
        @can('panel_others_profile_setting')
            <li class="sidenav-item {{ (request()->is('panel/setting')) ? 'sidenav-item-active' : '' }}">
                <a href="/panel/setting" class="d-flex align-items-center">
                    <span class="sidenav-setting-icon sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.setting')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.settings') }}</span>
                </a>
            </li>
        @endcan

        {{-- My Profile --}}
        @if($authUser->isTeacher() or $authUser->isOrganization())
            @can('panel_others_profile_url')
                <li class="sidenav-item ">
                    <a href="{{ $authUser->getProfileUrl() }}" class="d-flex align-items-center">
                        <span class="sidenav-item-icon assign-strock mr-10">
                            <i data-feather="user" stroke="#1f3b64" stroke-width="1.5" width="24" height="24" class="mr-10 webinar-icon"></i>
                        </span>
                        <span class="font-14 text-dark-blue font-weight-500">{{ trans('public.my_profile') }}</span>
                    </a>
                </li>
            @endcan
        @endif

        {{-- Log out --}}
        @can('panel_others_logout')
            <li class="sidenav-item">
                <a href="/logout" class="d-flex align-items-center">
                    <span class="sidenav-logout-icon sidenav-item-icon mr-10">
                        @include('web.default.panel.includes.sidebar_icons.logout')
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">{{ trans('panel.log_out') }}</span>
                </a>
            </li>
        @endcan

    </ul>
</div>
