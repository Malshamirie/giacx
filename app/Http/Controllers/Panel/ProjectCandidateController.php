<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCandidate;
use Illuminate\Http\Request;

class ProjectCandidateController extends Controller
{
    /**
     * عرض قائمة المرشحين للمشروع
     */
    public function index($projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->with(['candidates.user'])->findOrFail($projectId);
        
        return view('web.default.panel.projects.candidates.index', compact('project'));
    }

    /**
     * البحث عن طلاب متاحين لإضافتهم كمرشحين
     */
    public function search(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $request->validate([
            'term' => 'required|string|min:2'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);

        // البحث عن مستخدمين ليسوا مرشحين بالفعل
        $existingCandidateIds = $project->candidates()->pluck('user_id')->toArray();
        
        $users = \App\User::where('role_name', 'user')
            ->where('organ_id', $project->organization_id)
            ->whereNotIn('id', $existingCandidateIds)
            ->where(function($query) use ($request) {
                $query->where('full_name', 'like', '%' . $request->term . '%')
                      ->orWhere('email', 'like', '%' . $request->term . '%');
            })
            ->select('id', 'full_name', 'email')
            ->limit(20)
            ->get();

        return response()->json($users);
    }

    /**
     * إضافة مرشحين جدد للمشروع
     */
    public function store(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|exists:users,id'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $addedCount = 0;

        foreach ($request->student_ids as $studentId) {
            // التحقق من أن المستخدم ليس مرشح بالفعل
            if (!$project->candidates()->where('user_id', $studentId)->exists()) {
                ProjectCandidate::create([
                    'project_id' => $project->id,
                    'user_id' => $studentId,
                    'status' => 'active'
                ]);
                $addedCount++;
            }
        }

        $message = trans_choice('panel.candidates_added_successfully', $addedCount, ['count' => $addedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * تحديث حالة المرشح
     */
    public function update(Request $request, $projectId, $candidateId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $candidate = $project->candidates()->where('id', $candidateId)->firstOrFail();
        
        $candidate->update(['status' => $request->status]);

        return response()->json([
            'code' => 200,
            'message' => trans('panel.candidate_updated_successfully')
        ], 200);
    }

    /**
     * حذف مرشح من المشروع
     */
    public function destroy($projectId, $candidateId)
    {
        $this->authorize('panel_organization_projects_edit');

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $candidate = $project->candidates()->where('id', $candidateId)->firstOrFail();
        
        $candidate->delete();

        return response()->json([
            'code' => 200,
            'message' => trans('panel.candidate_removed_successfully')
        ], 200);
    }

    /**
     * حذف عدة مرشحين دفعة واحدة
     */
    public function destroyMultiple(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'candidate_ids' => 'required|array|min:1',
            'candidate_ids.*' => 'required|exists:project_candidates,id'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $deletedCount = 0;

        foreach ($request->candidate_ids as $candidateId) {
            $candidate = $project->candidates()->where('id', $candidateId)->first();
            if ($candidate) {
                $candidate->delete();
                $deletedCount++;
            }
        }

        $message = trans_choice('panel.candidates_removed_successfully', $deletedCount, ['count' => $deletedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }
}
