<li data-id="{{ !empty($file) ? $file->id :'' }}" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="file_{{ !empty($file) ? $file->id :'record' }}">
        <div class="d-flex align-items-center" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#filesAccordion" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block">{{ !empty($file) ? $file->file_name : trans('panel.add_new_files') }}</div>
        </div>

        <div class="d-flex align-items-center">
            @if(!empty($file) and $file->status != \App\Models\ProjectFile::$Active)
                <span class="disabled-content-badge mr-10">{{ trans('public.disabled') }}</span>
            @endif

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            @if(!empty($file))
                <a href="/panel/projects/files/{{ $file->id }}/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            @endif

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-controls="collapseFile{{ !empty($file) ? $file->id :'record' }}" data-parent="#filesAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseFile{{ !empty($file) ? $file->id :'record' }}" aria-labelledby="file_{{ !empty($file) ? $file->id :'record' }}" class=" collapse @if(empty($file)) show @endif" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form file-form" data-action="/panel/projects/files/{{ !empty($file) ? $file->id . '/update' : 'store' }}">
                <input type="hidden" name="project_id" value="{{ !empty($project) ? $project->id :'' }}">

                <div class="row">
                    <div class="col-12 col-lg-6">

                        <div class="form-group">
                            <label class="input-label">{{ trans('public.title') }}</label>
                            <input type="text" name="title" class="js-ajax-title form-control" value="{{ !empty($file) ? $file->file_name : '' }}" placeholder="{{ trans('forms.maximum_255_characters') }}"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group js-file-path-input">
                            <div class="local-input input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager text-white" data-input="file_path{{ !empty($file) ? $file->id : 'record' }}" data-preview="holder">
                                        <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="path" id="file_path{{ !empty($file) ? $file->id : 'record' }}" value="{{ (!empty($file)) ? $file->file_path : '' }}" class="js-ajax-file_path form-control" placeholder="{{ trans('panel.file_upload_placeholder') }}"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row form-group js-file-type-volume">
                            <div class="col-6">
                                <label class="input-label">{{ trans('panel.file_type') }}</label>
                                <select name="file_type" class="js-ajax-file_type form-control">
                                    <option value="">{{ trans('panel.select_file_type') }}</option>

                                    @foreach(\App\Models\File::$fileTypes as $fileType)
                                        <option value="{{ $fileType }}" @if(!empty($file) and $file->file_type == $fileType) selected @endif>{{ trans('update.file_type_'.$fileType) }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-6">
                                <label class="input-label">{{ trans('panel.file_volume') }}</label>
                                <input type="text" name="volume" value="{{ (!empty($file)) ? $file->file_size : '' }}" class="js-ajax-volume form-control" placeholder="{{ trans('panel.online_file_volume') }}"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">{{ trans('public.description') }}</label>
                            <textarea name="description" rows="4" class="js-ajax-description form-control" placeholder="{{ trans('public.description') }}">{{ !empty($file) ? $file->description : '' }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group mt-20">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}">{{ trans('public.active') }}</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" class="custom-control-input" id="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}" {{ (empty($file) or $file->status == \App\Models\ProjectFile::$Active) ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="fileStatusSwitch{{ !empty($file) ? $file->id : '_record' }}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-file btn btn-sm btn-primary">{{ trans('public.save') }}</button>

                    @if(empty($file))
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">{{ trans('public.close') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li> 