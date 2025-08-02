<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Webinar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $projects = Project::where('organization_id', $user->id)
            ->with(['projectManager', 'projectCoordinator', 'projectConsultant'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('panel.projects'),
            'projects' => $projects,
        ];

        return view('web.default.panel.projects.index', $data);
    }

    public function create()
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $managers = $user->getOrganizationManagers()->get();
        $webinars = Webinar::where('creator_id', $user->id)
            ->where('status', 'active')
            ->get();

        $data = [
            'pageTitle' => trans('panel.create_project'),
            'managers' => $managers,
            'webinars' => $webinars,
        ];

        return view('web.default.panel.projects.create', $data);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'field' => 'required|in:training,consulting,other_services',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'project_manager_id' => 'required|exists:users,id',
            'project_coordinator_id' => 'nullable|exists:users,id',
            'project_consultant_id' => 'nullable|exists:users,id',
            'venue_type' => 'required|in:hotel,client_venue,center_venue',
            'logistics_services' => 'required|in:coffee_break,lunch,other',
            'instructions' => 'nullable|string',
            'webinar_ids' => 'nullable|array',
            'webinar_ids.*' => 'exists:webinars,id',
            'files.*' => 'nullable|file|max:10240', // 10MB max
        ]);

        $data = $request->all();
        $data['organization_id'] = $user->id;

        $project = Project::create($data);

        // ربط الدورات بالمشروع
        if (!empty($data['webinar_ids'])) {
            $project->webinars()->attach($data['webinar_ids']);
        }

        // رفع الملفات
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/projects/' . $project->id, $fileName);

                ProjectFile::create([
                    'project_id' => $project->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'created_at' => time(),
                ]);
            }
        }

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('panel.project_created_successfully'),
            'status' => 'success'
        ];

        return redirect(route('panelProjects'))->with(['toast' => $toastData]);
    }

    public function show($id)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $project = Project::where('id', $id)
            ->where('organization_id', $user->id)
            ->with(['projectManager', 'projectCoordinator', 'projectConsultant', 'files', 'webinars', 'participants'])
            ->firstOrFail();

        $data = [
            'pageTitle' => $project->name,
            'project' => $project,
        ];

        return view('web.default.panel.projects.show', $data);
    }

    public function edit($id)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $project = Project::where('id', $id)
            ->where('organization_id', $user->id)
            ->with(['webinars'])
            ->firstOrFail();

        $managers = $user->getOrganizationManagers()->get();
        $webinars = Webinar::where('creator_id', $user->id)
            ->where('status', 'active')
            ->get();

        $data = [
            'pageTitle' => trans('panel.edit_project'),
            'project' => $project,
            'managers' => $managers,
            'webinars' => $webinars,
        ];

        return view('web.default.panel.projects.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $project = Project::where('id', $id)
            ->where('organization_id', $user->id)
            ->firstOrFail();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'field' => 'required|in:training,consulting,other_services',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'project_manager_id' => 'required|exists:users,id',
            'project_coordinator_id' => 'nullable|exists:users,id',
            'project_consultant_id' => 'nullable|exists:users,id',
            'venue_type' => 'required|in:hotel,client_venue,center_venue',
            'logistics_services' => 'required|in:coffee_break,lunch,other',
            'instructions' => 'nullable|string',
            'webinar_ids' => 'nullable|array',
            'webinar_ids.*' => 'exists:webinars,id',
            'files.*' => 'nullable|file|max:10240', // 10MB max
        ]);

        $data = $request->all();
        $project->update($data);

        // تحديث الدورات المرتبطة
        $project->webinars()->sync($data['webinar_ids'] ?? []);

        // رفع ملفات جديدة
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/projects/' . $project->id, $fileName);

                ProjectFile::create([
                    'project_id' => $project->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'created_at' => time(),
                ]);
            }
        }

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('panel.project_updated_successfully'),
            'status' => 'success'
        ];

        return redirect(route('panelProjects'))->with(['toast' => $toastData]);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $project = Project::where('id', $id)
            ->where('organization_id', $user->id)
            ->firstOrFail();

        // حذف الملفات
        foreach ($project->files as $file) {
            Storage::delete($file->file_path);
        }

        $project->delete();

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('panel.project_deleted_successfully'),
            'status' => 'success'
        ];

        return redirect(route('panelProjects'))->with(['toast' => $toastData]);
    }

    public function deleteFile($projectId, $fileId)
    {
        $user = auth()->user();
        $this->checkAccess($user);

        $project = Project::where('id', $projectId)
            ->where('organization_id', $user->id)
            ->firstOrFail();

        $file = ProjectFile::where('id', $fileId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        Storage::delete($file->file_path);
        $file->delete();

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('panel.file_deleted_successfully'),
            'status' => 'success'
        ];

        return redirect()->back()->with(['toast' => $toastData]);
    }

    private function checkAccess($user)
    {
        if (!($user->isOrganization() || $user->isManager())) {
            abort(404);
        }
    }
} 