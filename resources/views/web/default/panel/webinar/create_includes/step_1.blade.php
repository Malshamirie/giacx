@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

<div class="row">
    <div class="col-12 col-md-4 mt-15">
        <div class="form-group">
            <label class="input-label">{{ trans('panel.select_project') }}</label>
            <select name="project_id" class="custom-select select2 @error('project_id') is-invalid @enderror">
                <option value="">{{ trans('panel.select_project') }}</option>
                @if(!empty($projects))
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ (old('project_id') == $project->id || (!empty($webinar) && $webinar->project_id == $project->id)) ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('project_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        @if(!empty(getGeneralSettings('content_translate')))
            <div class="form-group">
                <label class="input-label">{{ trans('auth.language') }}</label>
                <select name="locale" class="custom-select {{ !empty($webinar) ? 'js-edit-content-locale' : '' }}">
                    @foreach($userLanguages as $lang => $language)
                        <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }} {{ (!empty($definedLanguage) and is_array($definedLanguage) and in_array(mb_strtolower($lang), $definedLanguage)) ? '('. trans('public.content_defined') .')' : '' }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
        @endif


        <div class="form-group mt-15 ">
            <label class="input-label d-block">{{ trans('panel.course_type') }}</label>

            <select name="type" class="custom-select @error('type')  is-invalid @enderror">
                <option value="webinar" @if(!empty($webinar) and $webinar->isWebinar()) selected @endif>{{ trans('webinars.webinar') }}</option>
                <option value="course" @if(!empty($webinar) and $webinar->type == 'course') selected @endif>{{ trans('webinars.video_course') }}</option>
                <option>{{ trans('webinars.text_lesson') }} (Paid Plugin)</option>
            </select>

            @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        @if($isOrganization)
            <div class="form-group mt-15 ">
                <label class="input-label d-block">{{ trans('public.select_a_teacher') }}</label>

                <select name="teacher_id" class="custom-select @error('teacher_id')  is-invalid @enderror">
                    <option value="" {{ (!empty($webinar) and !empty($webinar->teacher_id)) ? '' : 'selected' }}>{{ trans('public.choose_instructor') }}</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ (!empty($webinar) && $webinar->teacher_id == $teacher->id) ? 'selected' : '' }}>{{ $teacher->full_name }}</option>
                    @endforeach
                </select>

                @error('teacher_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @endif


        <div class="form-group mt-15">
            <label class="input-label">{{ trans('public.title') }}</label>
            <input type="text" name="title" value="{{ (!empty($webinar) and !empty($webinar->translate($locale))) ? $webinar->translate($locale)->title : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('public.seo_description') }}</label>
            <input type="text" name="seo_description" value="{{ (!empty($webinar) and !empty($webinar->translate($locale))) ? $webinar->translate($locale)->seo_description : old('seo_description') }}" class="form-control @error('seo_description')  is-invalid @enderror " placeholder="{{ trans('forms.50_160_characters_preferred') }}"/>
            @error('seo_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('public.thumbnail_image') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text panel-file-manager" data-input="thumbnail" data-preview="holder">
                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                    </button>
                </div>
                <input type="text" name="thumbnail" id="thumbnail" value="{{ !empty($webinar) ? $webinar->thumbnail : old('thumbnail') }}" class="form-control @error('thumbnail')  is-invalid @enderror" placeholder="{{ trans('forms.course_thumbnail_size') }}"/>
                @error('thumbnail')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('public.cover_image') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text panel-file-manager" data-input="cover_image" data-preview="holder">
                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                    </button>
                </div>
                <input type="text" name="image_cover" id="cover_image" value="{{ !empty($webinar) ? $webinar->image_cover : old('image_cover') }}" placeholder="{{ trans('forms.course_cover_size') }}" class="form-control @error('image_cover')  is-invalid @enderror"/>
                @error('image_cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-25">
            <label class="input-label">{{ trans('public.demo_video') }} ({{ trans('public.optional') }})</label>

            <div class="">
                <label class="input-label font-12">{{ trans('public.source') }}</label>
                <select name="video_demo_source"
                        class="js-video-demo-source form-control"
                >
                    @php
                        $availableSources = getFeaturesSettings('available_sources');
                        // Ensure it's an array
                        if (!is_array($availableSources)) {
                            $availableSources = [];
                        }
                    @endphp
                    @foreach($availableSources as $source)
                        <option value="{{ $source }}" @if(!empty($webinar) and $webinar->video_demo_source == $source) selected @endif>{{ trans('update.file_source_'.$source) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="js-video-demo-other-inputs form-group mt-0 {{ (empty($webinar) or !in_array($webinar->video_demo_source, ['secure_host', 's3'])) ? '' : 'd-none' }}">
            <label class="input-label font-12">{{ trans('update.path') }}</label>
            <div class="input-group js-video-demo-path-input">
                <div class="input-group-prepend">
                    <button type="button" class="js-video-demo-path-upload input-group-text text-white panel-file-manager {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? '' : 'd-none' }}" data-input="demo_video" data-preview="holder">
                        <i data-feather="upload" width="18" height="18" class="text-white"></i>
                    </button>

                    <button type="button" class="js-video-demo-path-links rounded-left input-group-text input-group-text-rounded-left text-white {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? 'd-none' : '' }}">
                        <i data-feather="link" width="18" height="18" class="text-white"></i>
                    </button>
                </div>
                <input type="text" name="video_demo" id="demo_video" value="{{ !empty($webinar) ? $webinar->video_demo : old('video_demo') }}" class="form-control @error('video_demo')  is-invalid @enderror"/>
                @error('video_demo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group js-video-demo-file-input {{ (!empty($webinar) and in_array($webinar->video_demo_source, ['secure_host', 's3'])) ? '' : 'd-none' }}">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text text-white">
                        <i data-feather="upload" width="18" height="18" class="text-white"></i>
                    </button>
                </div>
                <div class="custom-file js-ajax-s3_file">
                    <input type="file" name="video_demo_file" class="custom-file-input cursor-pointer" id="video_demo_file" accept="video/*">
                    <label class="custom-file-label cursor-pointer" for="video_demo_file">{{ trans('update.choose_file') }}</label>
                </div>

                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group mt-15">
            <label class="input-label d-block">{{ trans('lang.training_type') }}</label>
            <select name="training_type" class="custom-select @error('training_type') is-invalid @enderror" id="training_type">
                <option value="online" @if((!empty($webinar) && $webinar->training_type == 'online') || old('training_type') == 'online') selected @endif>{{ trans('lang.online_training') }}</option>
                <option value="in_person" @if((!empty($webinar) && $webinar->training_type == 'in_person') || old('training_type') == 'in_person') selected @endif>{{ trans('lang.in_person_training') }}</option>
            </select>
            @error('training_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقول التدريب الحضوري -->
        <div id="in_person_fields" class="training-type-fields" style="display: none;">
            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.training_location_name') }}</label>
                <input type="text" name="training_location_name" value="{{ (!empty($webinar) ? $webinar->training_location_name : old('training_location_name')) }}" class="form-control @error('training_location_name') is-invalid @enderror" placeholder="{{ trans('lang.enter_location_name') }}"/>
                @error('training_location_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.training_date') }}</label>
                <input type="date" name="training_date" value="{{ (!empty($webinar) && $webinar->training_date) ? date('Y-m-d', $webinar->training_date) : old('training_date') }}" class="form-control @error('training_date') is-invalid @enderror"/>
                @error('training_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.training_time') }}</label>
                <input type="time" name="training_time" value="{{ (!empty($webinar) ? $webinar->training_time : old('training_time')) }}" class="form-control @error('training_time') is-invalid @enderror"/>
                @error('training_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.training_location_link') }} ({{ trans('public.optional') }})</label>
                <input type="url" name="training_location_link" value="{{ (!empty($webinar) ? $webinar->training_location_link : old('training_location_link')) }}" class="form-control @error('training_location_link') is-invalid @enderror" placeholder="{{ trans('lang.enter_location_link') }}"/>
                @error('training_location_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- حقول التدريب عن بعد -->
        <div id="online_fields" class="training-type-fields">
            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.online_training_link') }}</label>
                <input type="url" name="online_training_link" value="{{ (!empty($webinar) ? $webinar->online_training_link : old('online_training_link')) }}" class="form-control @error('online_training_link') is-invalid @enderror" placeholder="{{ trans('lang.enter_training_link') }}"/>
                @error('online_training_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">{{ trans('lang.online_link_activation_date') }}</label>
                <input type="datetime-local" name="online_link_activation_date" value="{{ (!empty($webinar) && $webinar->online_link_activation_date) ? date('Y-m-d\TH:i', $webinar->online_link_activation_date) : old('online_link_activation_date') }}" class="form-control @error('online_link_activation_date') is-invalid @enderror"/>
                @error('online_link_activation_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-15">
            <label class="input-label d-block">{{ trans('lang.registration_approval') }}</label>
            <select name="registration_approval" class="custom-select @error('registration_approval') is-invalid @enderror">
                <option value="automatic" @if((!empty($webinar) && $webinar->registration_approval == 'automatic') || old('registration_approval') == 'automatic') selected @endif>{{ trans('lang.automatic_approval') }}</option>
                <option value="manual" @if((!empty($webinar) && $webinar->registration_approval == 'manual') || old('registration_approval') == 'manual') selected @endif>{{ trans('lang.manual_approval') }}</option>
            </select>
            @error('registration_approval')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label d-block">{{ trans('lang.certificate_type') }}</label>
            <select name="certificate_type" class="custom-select @error('certificate_type') is-invalid @enderror">
                <option value="attendance" @if((!empty($webinar) && $webinar->certificate_type == 'attendance') || old('certificate_type') == 'attendance') selected @endif>{{ trans('lang.attendance_certificate') }}</option>
                <option value="accredited_attendance" @if((!empty($webinar) && $webinar->certificate_type == 'accredited_attendance') || old('certificate_type') == 'accredited_attendance') selected @endif>{{ trans('lang.accredited_attendance_certificate') }}</option>
            </select>
            @error('certificate_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label class="input-label">{{ trans('public.description') }}</label>
            <textarea id="summernote" name="description" class="form-control @error('description')  is-invalid @enderror" placeholder="{{ trans('forms.webinar_description_placeholder') }}">{!! (!empty($webinar) and !empty($webinar->translate($locale))) ? $webinar->translate($locale)->description : old('description')  !!}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

@if($isOrganization)
    <div class="row">
        <div class="col-6">

            <div class="form-group mt-30 d-flex align-items-center">
                <label class="cursor-pointer mb-0 input-label" for="privateSwitch">{{ trans('webinars.private') }}</label>
                <div class="ml-30 custom-control custom-switch">
                    <input type="checkbox" name="private" class="custom-control-input" id="privateSwitch" {{ (!empty($webinar) and $webinar->private) ? 'checked' :  '' }}>
                    <label class="custom-control-label" for="privateSwitch"></label>
                </div>
            </div>

            <p class="text-gray font-12">{{ trans('webinars.create_private_course_hint') }}</p>
        </div>
    </div>
@endif

@push('scripts_bottom')
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>

    @push('scripts_bottom')
        <script>
            var videoDemoPathPlaceHolderBySource = {
                upload: '{{ trans('update.file_source_upload_placeholder') }}',
                youtube: '{{ trans('update.file_source_youtube_placeholder') }}',
                vimeo: '{{ trans('update.file_source_vimeo_placeholder') }}',
                external_link: '{{ trans('update.file_source_external_link_placeholder') }}',
                secure_host: '{{ trans('update.file_source_secure_host_placeholder') }}',
            }
        </script>
    @endpush

    <script>
        $(document).ready(function() {
            // التحكم في إظهار/إخفاء الحقول حسب نوع التدريب
            function toggleTrainingFields() {
                var trainingType = $('#training_type').val();
                
                if (trainingType === 'in_person') {
                    $('#in_person_fields').show();
                    $('#online_fields').hide();
                } else {
                    $('#in_person_fields').hide();
                    $('#online_fields').show();
                }
            }
            
            // تشغيل الدالة عند تحميل الصفحة
            toggleTrainingFields();
            
            // تشغيل الدالة عند تغيير نوع التدريب
            $('#training_type').on('change', function() {
                toggleTrainingFields();
            });
        });
    </script>
@endpush
