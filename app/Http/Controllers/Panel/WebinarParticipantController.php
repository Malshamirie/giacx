<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\Project;
use App\Models\ProjectCandidate;
use App\Models\WebinarParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebinarParticipantController extends Controller
{
    /**
     * عرض قائمة المشاركين في الكورس
     */
    public function index($webinarId)
    {
        $this->authorize('panel_organization_projects_lists');

        $webinar = Webinar::findOrFail($webinarId);
        
        // التحقق من أن الكورس مرتبط بمشروع
        if (!$webinar->project_id) {
            abort(404, 'هذا الكورس غير مرتبط بأي مشروع');
        }

        $project = Project::findOrFail($webinar->project_id);
        
        // التحقق من الصلاحيات
        $user = auth()->user();
        if ($user->isOrganization() && $project->organization_id !== $user->id) {
            abort(403);
        } elseif ($user->isManager() && $project->organization_id !== $user->organ_id) {
            abort(403);
        }

        return view('web.default.panel.webinar.webinar_participants.index', compact('webinar', 'project'));
    }

    /**
     * إضافة مشاركين جدد للكورس
     */
    public function store(Request $request, $webinarId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'candidate_ids' => 'required|array|min:1',
            'candidate_ids.*' => 'required|exists:project_candidates,id'
        ]);

        $webinar = Webinar::findOrFail($webinarId);
        
        if (!$webinar->project_id) {
            return response()->json([
                'code' => 400,
                'message' => 'هذا الكورس غير مرتبط بأي مشروع'
            ], 400);
        }

        $project = Project::findOrFail($webinar->project_id);
        
        // التحقق من الصلاحيات
        $user = auth()->user();
        if ($user->isOrganization() && $project->organization_id !== $user->id) {
            abort(403);
        } elseif ($user->isManager() && $project->organization_id !== $user->organ_id) {
            abort(403);
        }

        $addedCount = 0;

        foreach ($request->candidate_ids as $candidateId) {
            // التحقق من أن المرشح ينتمي للمشروع
            $candidate = ProjectCandidate::where('id', $candidateId)
                ->where('project_id', $project->id)
                ->first();

            if ($candidate && !$webinar->participants()->where('user_id', $candidate->user_id)->exists()) {
                WebinarParticipant::create([
                    'webinar_id' => $webinar->id,
                    'user_id' => $candidate->user_id,
                    'project_id' => $project->id,
                    'status' => 'active'
                ]);
                $addedCount++;
            }
        }

        $message = trans_choice('panel.participants_added_successfully', $addedCount, ['count' => $addedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * تحديث حالة المشارك
     */
    public function update(Request $request, $webinarId, $participantId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $webinar = Webinar::findOrFail($webinarId);
        $participant = WebinarParticipant::where('webinar_id', $webinar->id)
            ->where('id', $participantId)
            ->firstOrFail();

        $participant->update(['status' => $request->status]);

        $message = trans('panel.participant_updated_successfully');

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * حذف مشارك من الكورس
     */
    public function destroy($webinarId, $participantId)
    {
        $this->authorize('panel_organization_projects_edit');

        $webinar = Webinar::findOrFail($webinarId);
        $participant = WebinarParticipant::where('webinar_id', $webinar->id)
            ->where('id', $participantId)
            ->firstOrFail();

        $participant->delete();

        $message = trans('panel.participant_removed_successfully');

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * حذف عدة مشاركين
     */
    public function destroyMultiple(Request $request, $webinarId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'participant_ids' => 'required|array|min:1',
            'participant_ids.*' => 'required|exists:webinar_participants,id'
        ]);

        $webinar = Webinar::findOrFail($webinarId);
        
        $deletedCount = WebinarParticipant::where('webinar_id', $webinar->id)
            ->whereIn('id', $request->participant_ids)
            ->delete();

        $message = trans_choice('panel.participants_removed_successfully', $deletedCount, ['count' => $deletedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }
}
