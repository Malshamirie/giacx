<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Project;
use App\Models\ProjectManagerConnection;

class ProjectOrganizationalChart extends Model
{
    protected $table = 'project_organizational_charts';
    
    protected $fillable = [
        'project_id', 
        'manager_id', 
        'parent_id', 
        'position_x', 
        'position_y', 
        'role_type', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Constants for role types
    const ROLE_GENERAL_MANAGER = 'general_manager';
    const ROLE_DEPARTMENT_MANAGER = 'department_manager';
    const ROLE_EXECUTIVE_MANAGER = 'executive_manager';
    const ROLE_SECTION_SUPERVISOR = 'section_supervisor';
    const ROLE_DEPARTMENT_SUPERVISOR = 'department_supervisor';

    public static function getRoleTypes()
    {
        return [
            self::ROLE_GENERAL_MANAGER => trans('panel.general_manager'),
            self::ROLE_DEPARTMENT_MANAGER => trans('panel.department_manager'),
            self::ROLE_EXECUTIVE_MANAGER => trans('panel.executive_manager'),
            self::ROLE_SECTION_SUPERVISOR => trans('panel.section_supervisor'),
            self::ROLE_DEPARTMENT_SUPERVISOR => trans('panel.department_supervisor'),
        ];
    }

    public function getRoleTypeLabelAttribute()
    {
        $roles = self::getRoleTypes();
        return $roles[$this->role_type] ?? $this->role_type;
    }

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function parent()
    {
        return $this->belongsTo(ProjectOrganizationalChart::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProjectOrganizationalChart::class, 'parent_id');
    }

    public function connections()
    {
        return $this->hasMany(ProjectManagerConnection::class, 'from_manager_id', 'manager_id');
    }

    public function incomingConnections()
    {
        return $this->hasMany(ProjectManagerConnection::class, 'to_manager_id', 'manager_id');
    }
}
