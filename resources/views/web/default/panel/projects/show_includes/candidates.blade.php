<div class="tab-pane fade" id="candidates">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ trans('panel.candidates') }} ({{ $project->candidates()->count() }})</h5>
                <div class="d-flex align-items-center">
                    <button type="button" id="addCandidatesBtn" class="btn btn-primary ml-3">
                        <i class="fas fa-plus"></i>
                        {{ trans('panel.add_candidates') }}
                    </button>
                    <a href="{{ route('panel.projects.candidates.index', $project->id) }}" class="btn btn-outline-primary ml-2">
                        <i class="fas fa-list"></i>
                        {{ trans('panel.manage_candidates') }}
                    </a>
                </div>
            </div>
            @include('web.default.panel.projects.candidates.lists')
        </div>
    </div>
</div>
