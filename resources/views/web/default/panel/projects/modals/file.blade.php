<div class="modal fade" id="projectFileModal" tabindex="-1" role="dialog" aria-labelledby="projectFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectFileModalLabel">{{ trans('panel.add_file') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/panel/projects/files/store" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="project_id" value="{{ !empty($project) ? $project->id : 'new' }}">

                    <div class="form-group">
                        <label class="input-label">{{ trans('public.title') }}</label>
                        <input type="text" name="title" class="form-control" placeholder="{{ trans('forms.maximum_255_characters') }}"/>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group js-file-path-input">
                        <div class="local-input input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager text-white" data-input="file_path_record" data-preview="holder">
                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="path" id="file_path_record" value="" class="js-file_path form-control" placeholder="{{ trans('panel.file_upload_placeholder') }}"/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row form-group js-file-type-volume">
                        <div class="col-6">
                            <label class="input-label">{{ trans('panel.file_type') }}</label>
                            <select name="file_type" class="js-ajax-file_type form-control">
                                <option value="">{{ trans('panel.select_file_type') }}</option>

                                @foreach(\App\Models\File::$fileTypes as $fileType)
                                    <option value="{{ $fileType }}" >{{ trans('update.file_type_'.$fileType) }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6">
                            <label class="input-label">{{ trans('panel.file_volume') }}</label>
                            <input type="text" name="volume" value="" class="js-ajax-volume form-control" placeholder="{{ trans('panel.online_file_volume') }}"/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">{{ trans('public.description') }}</label>
                        <textarea name="description" rows="4" class="js-description form-control" placeholder="{{ trans('public.description') }}"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group mt-20">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="cursor-pointer input-label" for="fileStatusSwitch_record">{{ trans('public.active') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input" id="fileStatusSwitch_record" checked>
                                <label class="custom-control-label" for="fileStatusSwitch_record"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('public.close') }}</button>
                <button type="button" class="btn btn-primary js-save-file-modal">{{ trans('public.save') }}</button>
            </div>
        </div>
    </div>
</div> 