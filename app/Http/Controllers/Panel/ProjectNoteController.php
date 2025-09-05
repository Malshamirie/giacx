<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectNote;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    /**
     * Display the notes page for a project.
     */
    public function index($projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

       

        $project = $query->with(['notes.user'])->findOrFail($projectId);
        $notes = $project->notes;

        $data = [
            'pageTitle' => trans('panel.project_notes'),
            'project' => $project,
            'notes' => $notes,
        ];
        return view('web.default.panel.projects.notes.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);

        $request->validate([
            'content' => 'required|string'
        ]);

        $note = ProjectNote::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'content' => $request->content
        ]);

        $toastData = [
            'title' => trans('public.request_success'),
            'status' => 'success'
        ];
        return back()->with(['toast' => $toastData]);
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId, $noteId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $note = $project->notes()->with('user')->findOrFail($noteId);

        return response()->json([
            'success' => true,
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $projectId, $noteId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $note = $project->notes()->findOrFail($noteId);

        // Check if user can edit this note (owner or admin)
        if ($note->user_id !== $user->id && !$user->isAdmin()) {
            return response()->json(['success' => false, 'message' => trans('panel.unauthorized')], 403);
        }

        $request->validate([
            'content' => 'required|string'
        ]);

        $note->update([
            'content' => $request->content
        ]);

        $toastData = [
            'title' => trans('public.request_success'),
            'status' => 'success'
        ];
        return back()->with(['toast' => $toastData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $noteId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $note = $project->notes()->findOrFail($noteId);

        // Check if user can delete this note (owner or admin)
        if ($note->user_id !== $user->id && !$user->isAdmin()) {
            return response()->json(['success' => false, 'message' => trans('panel.unauthorized')], 403);
        }

        $note->delete();

        return response()->json([
            'success' => true,
            'message' => trans('panel.note_deleted_successfully')
        ], 200);
    }

}