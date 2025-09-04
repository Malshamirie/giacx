@extends('web.default.panel.layouts.panel_layout')

@section('pageTitle', trans('panel.candidates'))

@push('styles_top')
<link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <div class="page-header d-print-none mb-2">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ trans('panel.candidates') }} - {{ $project->name }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCandidatesModal">
                            <i class="fas fa-plus"></i>
                            {{ trans('panel.add_candidates') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('panel.candidates_list') }}</h3>
                </div>
                <div class="card-body">
                    @include('web.default.panel.projects.candidates.lists')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal إضافة المرشحين -->
    <div class="modal fade" id="addCandidatesModal" tabindex="-1" role="dialog" aria-labelledby="addCandidatesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCandidatesModalLabel">{{ trans('panel.add_candidates') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addCandidatesForm">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-label d-block">{{ trans('panel.select_students') }}</label>
                            <select name="student_ids[]" class="form-control select2" multiple="multiple" data-placeholder="{{ trans('panel.search_and_select_students') }}">
                                @php
                                    // جلب الطلاب التابعين للمنظمة
                                    $organizationStudents = \App\User::where('role_name', 'user')
                                        ->where('organ_id', $project->organization_id)
                                        ->whereNotIn('id', $project->candidates->pluck('user_id'))
                                        ->get();
                                @endphp
                                
                                @foreach($organizationStudents as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->full_name }} ({{ $student->email }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('public.close') }}</button>
                        <button type="submit" class="btn btn-primary" id="saveCandidatesBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            {{ trans('public.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
@include('web.default.panel.projects.candidates.js')
@endpush
