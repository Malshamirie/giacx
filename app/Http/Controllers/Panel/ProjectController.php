<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectParticipant;
use App\Models\ProjectWebinar;
use App\User;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
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

        $projects = $query->with(['organization', 'projectManager', 'projectCoordinator', 'projectConsultant'])
            ->withCount(['webinars', 'participants'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('web.default.panel.projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('panel_organization_projects_create');

        $user = auth()->user();
        $managers = collect();

        if ($user->isOrganization()) {
            $managers = User::where('organ_id', $user->id)
                ->where('role_name', 'manager')
                ->get();
        } elseif ($user->isManager() && $user->organ_id) {
            $managers = User::where('organ_id', $user->organ_id)
                ->where('role_name', 'manager')
                ->get();
        }

        return view('web.default.panel.projects.create', compact('managers'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        
        $this->authorize('panel_organization_projects_create');

        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'field' => 'required|in:training,consultation,other_services',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'project_manager_id' => 'required|exists:users,id',
            'project_coordinator_id' => 'nullable|exists:users,id',
            'project_consultant_id' => 'nullable|exists:users,id',
            'location' => 'required|string|max:255',
            'venue_type' => 'required|in:hotel,client_venue,center_venue',
            'logistics' => 'required',
            'instructions' => 'nullable|string',
            'uploaded_files' => 'nullable|array',
            'uploaded_files.*' => 'exists:project_files,id'
        ]);

      
        $data['slug'] = $request->slug ?? Str::slug($request->name);
    

        // Set organization ID
        if ($user->isOrganization()) {
            $data['organization_id'] = $user->id;
        } elseif ($user->isManager() && $user->organ_id) {
            $data['organization_id'] = $user->organ_id;
        }

        $data['name'] = $request->name;
        $data['field'] = $request->field;
        $data['project_manager_id'] = $request->project_manager_id;
        $data['project_coordinator_id'] = $request->project_coordinator_id;
        $data['project_consultant_id'] = $request->project_consultant_id;
        $data['location'] = $request->location;
        $data['venue_type'] = $request->venue_type;
        $data['logistics_services'] = $request->logistics;
        // return $request->start_date;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = 'active';
        $data['instructions'] = $request->instructions;
        $data['slug'] =  $request->slug ?? Str::slug($request->name);
        $data['organization_id'] = $user->id;

        $project = Project::create($data);

        // Link uploaded files
        if (!empty($data['uploaded_files'])) {
            ProjectFile::whereIn('id', $data['uploaded_files'])
                ->update(['project_id' => $project->id]);
        }

        // Create files from temporary storage
        $tempFiles = session('temp_project_files', []);
        // if(!empty($tempFiles)){
        // foreach ($tempFiles as $tempFile) {
        //     ProjectFile::create([
        //         'project_id' => $project->id,
        //         'file_path' => $tempFile['file_path'],
        //         'file_name' => $tempFile['file_name'],
        //         'file_size' => $tempFile['file_size'],
        //         'file_type' => $tempFile['file_type'],
        //         'description' => $tempFile['description'],
        //         'status' => $tempFile['status'],
        //     ]);
        // }
        // }
        // Clear temporary files from session
        session()->forget('temp_project_files');

        return redirect('/panel/projects')->with('msg', trans('panel.project_created_successfully'));
    }

    public function show($id)
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

        $project = $query->with([
            'organization', 
            'projectManager', 
            'projectCoordinator', 
            'projectConsultant',
            'files',
            'webinars.webinar',
            'participants.user'
        ])
        ->withCount(['webinars', 'participants'])
        ->findOrFail($id);

        return view('web.default.panel.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $this->authorize('panel_organization_projects_edit');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->with(['files'])->findOrFail($id);
        
        $managers = collect();
        if ($user->isOrganization()) {
            $managers = User::where('organ_id', $user->id)
                ->where('role_name', 'manager')
                ->get();
        } elseif ($user->isManager() && $user->organ_id) {
            $managers = User::where('organ_id', $user->organ_id)
                ->where('role_name', 'manager')
                ->get();
        }

        return view('web.default.panel.projects.edit', compact('project', 'managers'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('panel_organization_projects_edit');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:training,consultation,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $id,
            'project_manager_id' => 'required|exists:users,id',
            'project_coordinator_id' => 'nullable|exists:users,id',
            'project_consultant_id' => 'nullable|exists:users,id',
            'location' => 'required|string|max:255',
            'venue_type' => 'required|in:hotel,client_office,center_office',
            'logistics' => 'nullable|array',
            'logistics.*' => 'in:coffee_break,lunch,other',
            'instructions' => 'nullable|string',
            'status' => 'required|in:active,completed,pending'
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['logistics'] = json_encode($data['logistics'] ?? []);

        $project->update($data);

        return redirect('/panel/projects')->with('msg', trans('panel.project_updated_successfully'));
    }

    public function destroy($id)
    {
        $this->authorize('panel_organization_projects_delete');

        $user = auth()->user();
        $query = Project::query();

        // Filter by organization
        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($id);

        // Delete project files
        foreach ($project->files as $file) {
            $filePath = public_path($file->file_path);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $file->delete();
        }

        // Delete related records
        $project->webinars()->delete();
        $project->participants()->delete();
        $project->delete();

        return redirect('/panel/projects')->with('msg', trans('panel.project_deleted_successfully'));

        return redirect('/panel/projects')->with('msg', trans('panel.project_deleted_successfully'));
    }

    // File management methods
    public function storeFile(Request $request)
    {
        $this->authorize('panel_organization_projects_create');

        $data = $request->all();

        $rules = [
            'project_id' => 'required',
            'title' => 'required|max:255',
            'path' => 'required|max:255',
            'description' => 'nullable',
            'file_type' => 'required',
            'volume' => 'required',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // If project_id is 'new', store in session for later
        if ($data['project_id'] === 'new') {
            $tempFiles = session('temp_project_files', []);
            $tempFiles[] = [
                'file_path' => $data['path'],
                'file_name' => $data['title'],
                'file_size' => $data['volume'],
                'file_type' => $data['file_type'],
                'description' => $data['description'] ?? null,
                'status' => (!empty($data['status']) and $data['status'] == 'on') ? ProjectFile::$Active : ProjectFile::$Inactive,
            ];
            session(['temp_project_files' => $tempFiles]);

            return response()->json([
                'code' => 200,
                'message' => 'File added to temporary storage'
            ], 200);
        }

        // Validate project exists
        $rules['project_id'] = 'exists:projects,id';
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);
        
        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($data['project_id']);

        $projectFile = ProjectFile::create([
            'project_id' => $data['project_id'],
            'file_path' => $data['path'],
            'file_name' => $data['title'],
            'file_size' => $data['volume'],
            'file_type' => $data['file_type'],
            'description' => $data['description'] ?? null,
            'status' => (!empty($data['status']) and $data['status'] == 'on') ? ProjectFile::$Active : ProjectFile::$Inactive,
            'created_at' => time()
        ]);

        return response()->json([
            'code' => 200,
            'file' => $projectFile
        ], 200);
    }

    public function updateFile(Request $request, $id)
    {
        $this->authorize('panel_organization_projects_edit');

        $data = $request->all();

        $rules = [
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|max:255',
            'path' => 'required|max:255',
            'description' => 'nullable',
            'file_type' => 'required',
            'volume' => 'required',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($data['project_id']);
        $projectFile = ProjectFile::where('id', $id)
            ->where('project_id', $data['project_id'])
            ->first();

        if (!empty($projectFile)) {
            $projectFile->update([
                'file_path' => $data['path'],
                'file_name' => $data['title'],
                'file_size' => $data['volume'],
                'file_type' => $data['file_type'],
                'description' => $data['description'] ?? null,
                'status' => (!empty($data['status']) and $data['status'] == 'on') ? ProjectFile::$Active : ProjectFile::$Inactive,
                'updated_at' => time()
            ]);

            return response()->json([
                'code' => 200,
                'file' => $projectFile
            ], 200);
        }

        abort(403);
    }

    public function deleteFile($id)
    {
        $this->authorize('panel_organization_projects_edit');

        $file = ProjectFile::findOrFail($id);
        
        // Check if user has access to this file
        $user = auth()->user();
        if ($file->project) {
            if ($user->isOrganization() && $file->project->organization_id != $user->id) {
                abort(403);
            } elseif ($user->isManager() && $file->project->organization_id != $user->organ_id) {
                abort(403);
            }
        }

        $filePath = public_path($file->file_path);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        $file->delete();

        return response()->json([
            'code' => 200,
            'message' => trans('panel.file_deleted_successfully')
        ], 200);
    }

    public function downloadFile($id)
    {
        $file = ProjectFile::with('project')->findOrFail($id);
        
        // Check if user has access to this file
        $user = auth()->user();
        if ($file->project) {
            if ($user->isOrganization() && $file->project->organization_id != $user->id) {
                abort(403);
            } elseif ($user->isManager() && $file->project->organization_id != $user->organ_id) {
                abort(403);
            }
        }

        $filePath = public_path($file->file_path);

        if (file_exists($filePath)) {
            $fileInfo = pathinfo($filePath);
            $type = (!empty($fileInfo) and !empty($fileInfo['extension'])) ? $fileInfo['extension'] : '';

            $fileName = str_replace(' ', '-', $file->file_name);
            $fileName = str_replace('.', '-', $fileName);
            $fileName .= '.' . $type;

            $headers = array(
                'Content-Type: application/' . $type,
            );

            return response()->download($filePath, $fileName, $headers);
        }

        abort(404);
    }

    // Participants management methods
    public function participants($projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->with(['participants.user'])->findOrFail($projectId);
        
        $availableStudents = User::where('role_name', 'user')
            ->where('organ_id', $project->organization_id)
            ->whereNotIn('id', $project->participants->pluck('user_id'))
            ->get();

        return view('web.default.panel.projects.participants', compact('project', 'availableStudents'));
    }

    public function addParticipant(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);

        // Check if user is already a participant
        if ($project->participants()->where('user_id', $request->user_id)->exists()) {
            return redirect()->back()->with('error', trans('panel.user_already_participant'));
        }

        $project->participants()->create([
            'user_id' => $request->user_id,
            'status' => 'active'
        ]);

        return redirect()->back()->with('msg', trans('panel.participant_added_successfully'));
    }

    public function removeParticipant($projectId, $userId)
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
        $project->participants()->where('user_id', $userId)->delete();

        return redirect()->back()->with('msg', trans('panel.participant_removed_successfully'));
    }

    // Webinars management methods
    public function webinars($projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->with(['webinars.webinar'])->findOrFail($projectId);
        
        $availableWebinars = Webinar::where('creator_id', $project->organization_id)
            ->whereNotIn('id', $project->webinars->pluck('webinar_id'))
            ->get();

        return view('web.default.panel.projects.webinars', compact('project', 'availableWebinars'));
    }

    public function addWebinar(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_edit');

        $request->validate([
            'webinar_id' => 'required|exists:webinars,id'
        ]);

        $user = auth()->user();
        $query = Project::query();

        if ($user->isOrganization()) {
            $query->where('organization_id', $user->id);
        } elseif ($user->isManager() && $user->organ_id) {
            $query->where('organization_id', $user->organ_id);
        }

        $project = $query->findOrFail($projectId);

        // Check if webinar is already added
        if ($project->webinars()->where('webinar_id', $request->webinar_id)->exists()) {
            return redirect()->back()->with('error', trans('panel.webinar_already_added'));
        }

        $project->webinars()->create([
            'webinar_id' => $request->webinar_id
        ]);

        return redirect()->back()->with('msg', trans('panel.webinar_added_successfully'));
    }

    public function removeWebinar($projectId, $webinarId)
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
        $project->webinars()->where('webinar_id', $webinarId)->delete();

        return redirect()->back()->with('msg', trans('panel.webinar_removed_successfully'));
    }
} 