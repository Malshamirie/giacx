@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/dropzone/dropzone.min.css">
@endpush

@section('content')
    <section>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="section-title mx-0">
                                <h2 class="section-title font-24 text-dark-blue font-weight-bold">{{ trans('panel.create_projects') }}</h2>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="/panel/projects" class="btn btn-sm btn-gray-200">{{ trans('panel.back') }}</a>
                        </div>
                    </div>

                    <div class="panel-section-card py-20 px-25 mt-20">
                        <form action="/panel/projects/store" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <!-- المعلومات الرئيسية -->
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.basic_information') }}</h3>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_field') }}</label>
                                        <div class="mt-10">            

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="field_training" name="field" value="training" class="custom-control-input" {{ old('field') == 'training' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="field_training">{{ trans('panel.training') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="field_consultation" name="field" value="consulting" class="custom-control-input" {{ old('field') == 'consultation' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="field_consultation">{{ trans('panel.consultation') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="field_other" name="field" value="other_services" class="custom-control-input" {{ old('field') == 'other' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="field_other">{{ trans('panel.other_services') }}</label>
                                            </div>
                                        </div>
                                        @error('field')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('public.name') }}</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('panel.enter_project_name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('public.start_date') }}</label>
                                        <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror" placeholder="YYYY-MM-DD">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.end_date') }}</label>
                                        <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror" placeholder="YYYY-MM-DD">
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.landing_page_slug') }}</label>
                                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="{{ trans('panel.enter_slug_or_leave_empty') }}">
                                        <small class="form-text text-muted">{{ trans('panel.slug_help_text') }}</small>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- مدراء المشروع -->
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.project_managers') }}</h3>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_manager') }}</label>
                                        <select name="project_manager_id" class="form-control select2 @error('project_manager_id') is-invalid @enderror">
                                            <option value="">{{ trans('panel.select_project_manager') }}</option>
                                            @foreach($managers as $manager)
                                                <option value="{{ $manager->id }}" {{ old('project_manager_id') == $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('project_manager_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_coordinator') }} ({{ trans('public.optional') }})</label>
                                        <select name="project_coordinator_id" class="form-control select2">
                                            <option value="">{{ trans('panel.select_project_coordinator') }}</option>
                                            @foreach($managers as $manager)
                                                <option value="{{ $manager->id }}" {{ old('project_coordinator_id') == $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_consultant') }} ({{ trans('public.optional') }})</label>
                                        <select name="project_consultant_id" class="form-control select2">
                                            <option value="">{{ trans('panel.select_project_consultant') }}</option>
                                            @foreach($managers as $manager)
                                                <option value="{{ $manager->id }}" {{ old('project_consultant_id') == $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- الخدمات -->
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.services') }}</h3>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_location') }}</label>
                                        <input type="text" name="location" value="{{ old('location') }}" class="form-control @error('location') is-invalid @enderror" placeholder="{{ trans('panel.enter_project_location') }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">

                                        <label class="input-label">{{ trans('panel.training_venue') }}</label>
                                        <select name="venue_type" class="form-control @error('venue_type') is-invalid @enderror">
                                            <option value="">{{ trans('panel.select_venue_type') }}</option>
                                            <option value="hotel" {{ old('venue_type') == 'hotel' ? 'selected' : '' }}>{{ trans('panel.hotel') }}</option>
                                            <option value="client_venue" {{ old('venue_type') == 'client_venue' ? 'selected' : '' }}>{{ trans('panel.client_office') }}</option>
                                            <option value="center_venue" {{ old('venue_type') == 'center_venue' ? 'selected' : '' }}>{{ trans('panel.center_office') }}</option>
                                        </select>
                                        @error('venue_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.logistics_services') }}</label>
                                        <div class="mt-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="logistics_coffee" name="logistics" value="coffee_break" class="custom-control-input" {{ old('logistics') == 'coffee_break' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="logistics_coffee">{{ trans('panel.coffee_break') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="logistics_lunch" name="logistics" value="lunch" class="custom-control-input" {{ old('logistics') == 'lunch' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="logistics_lunch">{{ trans('panel.lunch') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="logistics_other" name="logistics" value="other" class="custom-control-input" {{ old('logistics') == 'other' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="logistics_other">{{ trans('panel.other') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- تعليمات إضافية -->
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h3 class="font-16 text-dark-blue font-weight-bold mb-20">{{ trans('panel.additional_instructions') }}</h3>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_instructions') }}</label>
                                        <textarea name="instructions" rows="5" class="form-control @error('instructions') is-invalid @enderror" placeholder="{{ trans('panel.enter_project_instructions') }}">{{ old('instructions') }}</textarea>
                                        @error('instructions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('panel.project_files') }}</label>
                                        <div class="panel-section-card py-20 px-25">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="section-title mx-0">
                                                        <h2 class="section-title font-16 text-dark-blue font-weight-bold">{{ trans('panel.project_files') }}</h2>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#projectFileModal">
                                                        <i data-feather="plus" width="16" height="16" class="mr-5"></i>
                                                        {{ trans('panel.add_file') }}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-20">
                                                <div class="accordion-content-wrapper">
                                                    <div class="accordion" id="filesAccordion">
                                                        <!-- Files will be loaded here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-30">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ trans('public.save') }}</button>
                                    <a href="/panel/projects" class="btn btn-gray-200 ml-10">{{ trans('public.cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
    </section>
    @include('web.default.panel.projects.modals.file')
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
            
            // Initialize Date Picker
            $('input[name="start_date"], input[name="end_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            

            
            // File management - Modal save button
            $('.js-save-file-modal').on('click', function() {
                var $form = $('#projectFileModal form');
                var formData = new FormData($form[0]);
                
                $.ajax({
                    url: '/panel/projects/files/store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.code === 200) {
                            // Close modal
                            $('#projectFileModal').modal('hide');
                            // Clear form
                            $form[0].reset();
                            // Show success message
                            toastr.success('{{ trans("panel.file_added_successfully") }}');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $form.find('[name="' + field + '"]').addClass('is-invalid');
                                $form.find('[name="' + field + '"]').siblings('.invalid-feedback').text(messages[0]);
                            });
                        }
                    }
                });
            });
            
            // File management - Accordion save button
            $('.js-save-file').on('click', function() {
                var $form = $(this).closest('.file-form');
                var action = $form.data('action');
                var formData = new FormData($form[0]);
                
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.code === 200) {
                            // Reload files
                            loadProjectFiles();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $form.find('[name="' + field + '"]').addClass('is-invalid');
                                $form.find('[name="' + field + '"]').siblings('.invalid-feedback').text(messages[0]);
                            });
                        }
                    }
                });
            });
            
            // Delete file
            $('.delete-action').on('click', function(e) {
                e.preventDefault();
                
                if (confirm('{{ trans("public.are_you_sure_delete") }}')) {
                    var url = $(this).attr('href');
                    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                // Reload files
                                loadProjectFiles();
                            }
                        }
                    });
                }
            });
            
            // Cancel accordion
            $('.cancel-accordion').on('click', function() {
                $(this).closest('.accordion-row').remove();
            });
        });
        
        function loadProjectFiles() {
            // This function will be implemented to load project files
            // It will be called after project creation/update
        }
    </script>
@endpush 