<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectOrganizationalChart;
use App\Models\ProjectManagerConnection;
use App\User;
use Illuminate\Http\Request;

class ProjectOrganizationalChartController extends Controller
{
    /**
     * Display the organizational chart for a project.
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

        $project = $query->findOrFail($projectId);
        
        $chartData = $this->getChartData($projectId);
        $availableManagers = $this->getAvailableManagers($projectId);

        $data = [
            'pageTitle' => trans('panel.organizational_chart'),
            'project' => $project,
            'chartData' => $chartData,
            'availableManagers' => $availableManagers,
        ];
        
        return view('web.default.panel.projects.organizational_chart.index', $data);
    }

    /**
     * Store a newly created organizational chart entry.
     */
    public function store(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $request->validate([
            'manager_id' => 'required|exists:users,id',
            'parent_id' => 'nullable|exists:project_organizational_charts,id',
            'role_type' => 'required|in:general_manager,department_manager,executive_manager,section_supervisor,department_supervisor',
            'position_x' => 'integer|min:0',
            'position_y' => 'integer|min:0'
        ]);

        // Check if manager is already in the chart
        $existingChart = ProjectOrganizationalChart::where('project_id', $projectId)
            ->where('manager_id', $request->manager_id)
            ->first();

        if ($existingChart) {
            return response()->json([
                'success' => false,
                'message' => trans('panel.manager_already_in_chart')
            ], 400);
        }

        // Verify manager belongs to the organization
        if (!$this->isManagerBelongsToOrganization($request->manager_id)) {
            return response()->json([
                'success' => false,
                'message' => trans('panel.manager_not_found')
            ], 400);
        }

        $chart = ProjectOrganizationalChart::create([
            'project_id' => $projectId,
            'manager_id' => $request->manager_id,
            'parent_id' => $request->parent_id,
            'role_type' => $request->role_type,
            'position_x' => $request->position_x ?? 0,
            'position_y' => $request->position_y ?? 0
        ]);

        return response()->json([
            'success' => true,
            'chart' => $chart->load('manager'),
            'message' => trans('panel.manager_added_successfully')
        ]);
    }

    /**
     * Update the specified organizational chart entry.
     */
    public function update(Request $request, $projectId, $chartId)
    {
        $this->authorize('panel_organization_projects_lists');

        $request->validate([
            'role_type' => 'required|in:general_manager,department_manager,executive_manager,section_supervisor,department_supervisor',
            'position_x' => 'integer|min:0',
            'position_y' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $chart = ProjectOrganizationalChart::where('project_id', $projectId)
            ->findOrFail($chartId);

        $chart->update($request->only(['role_type', 'position_x', 'position_y', 'is_active']));

        return response()->json([
            'success' => true,
            'chart' => $chart->load('manager'),
            'message' => trans('panel.chart_updated_successfully')
        ]);
    }

    /**
     * Remove the specified organizational chart entry.
     */
    public function destroy($projectId, $chartId)
    {
        $this->authorize('panel_organization_projects_lists');

        $chart = ProjectOrganizationalChart::where('project_id', $projectId)
            ->findOrFail($chartId);

        // Delete all connections involving this manager
        ProjectManagerConnection::where('project_id', $projectId)
            ->where(function($query) use ($chart) {
                $query->where('from_manager_id', $chart->manager_id)
                      ->orWhere('to_manager_id', $chart->manager_id);
            })
            ->delete();

        $chart->delete();

        return response()->json([
            'success' => true,
            'message' => trans('panel.manager_removed_successfully')
        ]);
    }

    /**
     * Connect two managers.
     */
    public function connectManagers(Request $request, $projectId)
    {
        $this->authorize('panel_organization_projects_lists');

        $request->validate([
            'from_manager_id' => 'required|exists:users,id',
            'to_manager_id' => 'required|exists:users,id',
            'connection_type' => 'required|in:collaboration,reporting,coordination'
        ]);

        // Check if connection already exists
        $existingConnection = ProjectManagerConnection::where('project_id', $projectId)
            ->where('from_manager_id', $request->from_manager_id)
            ->where('to_manager_id', $request->to_manager_id)
            ->first();

        if ($existingConnection) {
            return response()->json([
                'success' => false,
                'message' => trans('panel.connection_already_exists')
            ], 400);
        }

        $connection = ProjectManagerConnection::create([
            'project_id' => $projectId,
            'from_manager_id' => $request->from_manager_id,
            'to_manager_id' => $request->to_manager_id,
            'connection_type' => $request->connection_type
        ]);

        return response()->json([
            'success' => true,
            'connection' => $connection->load(['fromManager', 'toManager']),
            'message' => trans('panel.managers_connected_successfully')
        ]);
    }

    /**
     * Disconnect two managers.
     */
    public function disconnectManagers($projectId, $connectionId)
    {
        $this->authorize('panel_organization_projects_lists');

        $connection = ProjectManagerConnection::where('project_id', $projectId)
            ->findOrFail($connectionId);

        $connection->delete();

        return response()->json([
            'success' => true,
            'message' => trans('panel.managers_disconnected_successfully')
        ]);
    }

    /**
     * Get chart data for the project.
     */
    private function getChartData($projectId)
    {
        $charts = ProjectOrganizationalChart::where('project_id', $projectId)
            ->where('is_active', true)
            ->with(['manager', 'parent.manager', 'children.manager', 'connections.toManager', 'incomingConnections.fromManager'])
            ->get();

        $connections = ProjectManagerConnection::where('project_id', $projectId)
            ->with(['fromManager', 'toManager'])
            ->get();

        return [
            'charts' => $charts,
            'connections' => $connections
        ];
    }

    /**
     * Get available managers for the project.
     */
    private function getAvailableManagers($projectId)
    {
        $user = auth()->user();
        $query = User::query();

        // Get organization managers
        if ($user->isOrganization()) {
            $query = $user->getOrganizationManagers();
        } elseif ($user->isManager() && $user->organ_id) {
            $organization = User::find($user->organ_id);
            if ($organization) {
                $query = $organization->getOrganizationManagers();
            }
        }

        // Exclude managers already in the chart
        $existingManagerIds = ProjectOrganizationalChart::where('project_id', $projectId)
            ->pluck('manager_id')
            ->toArray();

        $query->whereNotIn('id', $existingManagerIds);

        return $query->select('id', 'full_name', 'email', 'avatar')->get();
    }

    /**
     * Check if manager belongs to organization.
     */
    private function isManagerBelongsToOrganization($managerId)
    {
        $user = auth()->user();
        
        if ($user->isOrganization()) {
            return User::where('id', $managerId)
                ->where('organ_id', $user->id)
                ->where('role_name', 'manager')
                ->exists();
        } elseif ($user->isManager() && $user->organ_id) {
            return User::where('id', $managerId)
                ->where('organ_id', $user->organ_id)
                ->where('role_name', 'manager')
                ->exists();
        }
        
        return false;
    }
}
