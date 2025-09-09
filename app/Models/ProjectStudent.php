<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStudent extends Model
{
    protected $table = 'project_students';
    protected $guarded = ['id'];

    // Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const TYPE_PARTICIPANT = 'participant';
    const TYPE_CANDIDATE = 'candidate';

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

    public function scopeParticipants($query)
    {
        return $query->where('type', self::TYPE_PARTICIPANT);
    }

    public function scopeCandidates($query)
    {
        return $query->where('type', self::TYPE_CANDIDATE);
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

    public function getTypeLabelAttribute()
    {
        $labels = [
            self::TYPE_PARTICIPANT => trans('panel.participant'),
            self::TYPE_CANDIDATE => trans('panel.candidate'),
        ];

        return $labels[$this->type] ?? $this->type;
    }
}
