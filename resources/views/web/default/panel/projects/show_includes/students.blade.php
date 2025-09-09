<div class="tab-pane fade" id="students">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ trans('panel.students') }} ({{ $project->students()->count() }})</h5>
                <div class="d-flex align-items-center">
                    <button type="button" id="addstudentsBtn" class="btn btn-primary ml-3">
                        <i class="fas fa-plus"></i>
                        {{ trans('panel.add_students') }}
                    </button>
                    <a href="{{ route('panel.projects.students.index', $project->id) }}" class="btn btn-outline-primary ml-2">
                        <i class="fas fa-list"></i>
                        {{ trans('panel.manage_students') }}
                    </a>
                </div>
            </div>
            @include('web.default.panel.projects.students.lists')
        </div>
    </div>
</div>
