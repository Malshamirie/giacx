<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCandidate extends Model
{
    protected $table = 'project_candidates';
    protected $guarded = ['id'];

    // Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    // Relationships
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_ACTIVE => trans('panel.status_active'),
            self::STATUS_INACTIVE => trans('panel.status_inactive'),
        ];

        return $labels[$this->status] ?? $this->status;
    }
}
