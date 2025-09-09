<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectStudent;
use Illuminate\Http\Request;

class ProjectStudentController extends Controller
{
    /**
     * عرض قائمة الطالبين للمشروع
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

        $project = $query->findOrFail($projectId);
        
        // تطبيق الفلاتر على الطلاب
        $studentsQuery = $project->students()->with('user');
        $studentsQuery = $this->applyFilters($studentsQuery, request());
        
        $students = $studentsQuery->get();
        
        return view('web.default.panel.projects.students.index', compact('project', 'students'));
    }

    /**
     * تطبيق الفلاتر على استعلام الطلاب
     */
    private function applyFilters($query, $request)
    {
        // فلتر البحث العام
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->whereHas('user', function($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('mobile', 'like', "%{$searchTerm}%");
            });
        }

        // فلتر النوع (مشارك/مرشح)
        if ($request->filled('type')) {
            $query->where('type', $request->get('type'));
        }

        // فلتر الحالة (مفعل/غير مفعل)
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // فلتر التاريخ - معالجة محسنة للأخطاء
        if ($request->filled('from')) {
            try {
                $fromValue = $request->get('from');
                // محاولة تحليل التاريخ بطرق مختلفة
                if (strpos($fromValue, '/') !== false) {
                    $fromDate = \Carbon\Carbon::createFromFormat('Y/m/d', $fromValue)->startOfDay();
                } elseif (strpos($fromValue, '-') !== false) {
                    $fromDate = \Carbon\Carbon::createFromFormat('Y-m-d', $fromValue)->startOfDay();
                } else {
                    $fromDate = \Carbon\Carbon::parse($fromValue)->startOfDay();
                }
                $query->where('created_at', '>=', $fromDate);
            } catch (\Exception $e) {
                // تجاهل خطأ التاريخ إذا كان غير صحيح
                \Log::warning('Invalid from date format: ' . $request->get('from'));
            }
        }

        if ($request->filled('to')) {
            try {
                $toValue = $request->get('to');
                // محاولة تحليل التاريخ بطرق مختلفة
                if (strpos($toValue, '/') !== false) {
                    $toDate = \Carbon\Carbon::createFromFormat('Y/m/d', $toValue)->endOfDay();
                } elseif (strpos($toValue, '-') !== false) {
                    $toDate = \Carbon\Carbon::createFromFormat('Y-m-d', $toValue)->endOfDay();
                } else {
                    $toDate = \Carbon\Carbon::parse($toValue)->endOfDay();
                }
                $query->where('created_at', '<=', $toDate);
            } catch (\Exception $e) {
                // تجاهل خطأ التاريخ إذا كان غير صحيح
                \Log::warning('Invalid to date format: ' . $request->get('to'));
            }
        }

        // فلتر الترتيب
        if ($request->filled('sort')) {
            $sort = $request->get('sort');
            
            switch ($sort) {
                case 'name_asc':
                    $query->join('users', 'project_students.user_id', '=', 'users.id')
                          ->orderBy('users.full_name', 'asc')
                          ->select('project_students.*');
                    break;
                case 'name_desc':
                    $query->join('users', 'project_students.user_id', '=', 'users.id')
                          ->orderBy('users.full_name', 'desc')
                          ->select('project_students.*');
                    break;
                case 'email_asc':
                    $query->join('users', 'project_students.user_id', '=', 'users.id')
                          ->orderBy('users.email', 'asc')
                          ->select('project_students.*');
                    break;
                case 'email_desc':
                    $query->join('users', 'project_students.user_id', '=', 'users.id')
                          ->orderBy('users.email', 'desc')
                          ->select('project_students.*');
                    break;
                case 'created_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'created_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    /**
     * البحث عن طلاب متاحين لإضافتهم كطالبين
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

        // البحث عن مستخدمين ليسوا طالبين بالفعل
        $existingstudentIds = $project->students()->pluck('user_id')->toArray();
        
        $users = \App\User::where('role_name', 'user')
            ->where('organ_id', $project->organization_id)
            ->whereNotIn('id', $existingstudentIds)
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
     * إضافة طالبين جدد للمشروع
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
            // التحقق من أن المستخدم ليس طالب بالفعل
            if (!$project->students()->where('user_id', $studentId)->exists()) {
                ProjectStudent::create([
                    'project_id' => $project->id,
                    'user_id' => $studentId,
                    'status' => 'active'
                ]);
                $addedCount++;
            }
        }

        $message = trans_choice('panel.students_added_successfully', $addedCount, ['count' => $addedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * تحديث حالة الطالب
     */
    public function update(Request $request, $projectId, $studentId)
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
        $student = $project->students()->where('id', $studentId)->firstOrFail();
        
        $student->update(['status' => $request->status]);

        return response()->json([
            'code' => 200,
            'message' => trans('panel.student_updated_successfully')
        ], 200);
    }

    /**
     * حذف طالب من المشروع
     */
    public function destroy($projectId, $studentId)
    {
        try {
            $this->authorize('panel_organization_projects_edit');

            $user = auth()->user();
            $query = Project::query();

            if ($user->isOrganization()) {
                $query->where('organization_id', $user->id);
            } elseif ($user->isManager() && $user->organ_id) {
                $query->where('organization_id', $user->organ_id);
            }

            $project = $query->findOrFail($projectId);
            $student = $project->students()->where('id', $studentId)->firstOrFail();
            
            $student->delete();

            return response()->json([
                'code' => 200,
                'message' => trans('panel.student_removed_successfully')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * حذف عدة طالبين دفعة واحدة
     */
    public function destroyMultiple(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|exists:project_students,id'
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

        foreach ($request->student_ids as $studentId) {
            $student = $project->students()->where('id', $studentId)->first();
            if ($student) {
                $student->delete();
                $deletedCount++;
            }
        }

        $message = trans_choice('panel.students_removed_successfully', $deletedCount, ['count' => $deletedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * تحويل نوع طالب واحد
     */
    public function convertType(Request $request, $studentId)
    {
        try {
            $request->validate([
                'type' => 'required|in:participant,candidate'
            ]);

            $student = ProjectStudent::findOrFail($studentId);
            $oldType = $student->type;
            $newType = $request->type;
            
            $student->update(['type' => $newType]);
            
            $message = $newType === 'candidate' 
                ? trans('panel.successfully_converted_to_candidate')
                : trans('panel.successfully_converted_to_participant');
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('panel.error_occurred')
            ], 500);
        }
    }

    /**
     * تحويل نوع عدة طالبين دفعة واحدة
     */
    public function bulkConvertType(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|exists:project_students,id',
            'type' => 'required|in:participant,candidate'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);
        $updatedCount = 0;

        foreach ($request->student_ids as $studentId) {
            $student = $project->students()->where('id', $studentId)->first();
            if ($student) {
                $student->update(['type' => $request->type]);
                $updatedCount++;
            }
        }

        $message = $request->type === 'candidate' 
            ? trans_choice('panel.students_converted_to_candidate', $updatedCount, ['count' => $updatedCount])
            : trans_choice('panel.students_converted_to_participant', $updatedCount, ['count' => $updatedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }

    /**
     * تحديث حالة عدة طالبين دفعة واحدة
     */
    public function bulkUpdateStatus(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|exists:project_students,id',
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
        $updatedCount = 0;

        foreach ($request->student_ids as $studentId) {
            $student = $project->students()->where('id', $studentId)->first();
            if ($student) {
                $student->update(['status' => $request->status]);
                $updatedCount++;
            }
        }

        $message = $request->status === 'active' 
            ? trans_choice('panel.students_activated', $updatedCount, ['count' => $updatedCount])
            : trans_choice('panel.students_deactivated', $updatedCount, ['count' => $updatedCount]);

        return response()->json([
            'code' => 200,
            'message' => $message
        ], 200);
    }
}
