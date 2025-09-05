<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectManagerConnection extends Model
{
    protected $table = 'project_manager_connections';
    
    protected $fillable = [
        'project_id', 
        'from_manager_id', 
        'to_manager_id', 
        'connection_type'
    ];

    // Constants for connection types
    const TYPE_COLLABORATION = 'collaboration';
    const TYPE_REPORTING = 'reporting';
    const TYPE_COORDINATION = 'coordination';

    public static function getConnectionTypes()
    {
        return [
            self::TYPE_COLLABORATION => trans('panel.collaboration'),
            self::TYPE_REPORTING => trans('panel.reporting'),
            self::TYPE_COORDINATION => trans('panel.coordination'),
        ];
    }

    public function getConnectionTypeLabelAttribute()
    {
        $types = self::getConnectionTypes();
        return $types[$this->connection_type] ?? $this->connection_type;
    }

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function fromManager()
    {
        return $this->belongsTo(User::class, 'from_manager_id');
    }

    public function toManager()
    {
        return $this->belongsTo(User::class, 'to_manager_id');
    }
}
