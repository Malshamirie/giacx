@extends('web.default.panel.layouts.panel_layout')

@section('pageTitle', trans('panel.students'))

@push('styles_top')
<link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
<style>
.bulk-actions-bar {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.bulk-actions-bar .btn-group .btn {
    margin-right: 0.25rem;
}

.bulk-actions-bar .btn-group .btn:last-child {
    margin-right: 0;
}

#selectAll {
    transform: scale(1.2);
}

.student-checkbox {
    transform: scale(1.1);
}

.table-custom th:first-child,
.table-custom td:first-child {
    width: 50px;
    text-align: center;
}

.filters-section {
    background: #f8f9fa;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
}

.has-translation {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

.form-group {
    position: relative;
}

.form-group .form-control {
    padding-left: 40px;
}

.form-group-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
}
</style>
@endpush

@section('content')
    <div class="page-header d-print-none mb-2">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ trans('panel.students') }} - {{ $project->name }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstudentsModal">
                            <i class="fas fa-plus"></i>
                            {{ trans('panel.add_students') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- قسم الفلاتر -->
            <div class="card filters-section">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter"></i>
                        {{ trans('panel.filters') }}
                    </h3>
                </div>
                <div class="card-body">
                    @include('web.default.panel.projects.students.filters')
                </div>
            </div>

            <!-- قسم قائمة الطلاب -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('panel.students_list') }}</h3>
                </div>
                <div class="card-body">
                    @include('web.default.panel.projects.students.lists')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal إضافة الطالبين -->
    <div class="modal fade" id="addstudentsModal" tabindex="-1" role="dialog" aria-labelledby="addstudentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addstudentsModalLabel">{{ trans('panel.add_students') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addstudentsForm">
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
                                        ->whereNotIn('id', $project->students->pluck('user_id'))
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
                        <button type="submit" class="btn btn-primary" id="savestudentsBtn">
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
@include('web.default.panel.projects.students.js')
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
<script src="/assets/default/vendors/select2/select2.min.js"></script>
@endpush
