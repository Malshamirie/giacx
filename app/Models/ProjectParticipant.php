<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectParticipant extends Model
{
    protected $table = 'project_participants';
    protected $guarded = ['id'];

    // Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_DROPPED = 'dropped';

    // Relationships
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
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

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeDropped($query)
    {
        return $query->where('status', self::STATUS_DROPPED);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_ACTIVE => trans('panel.status_active'),
            self::STATUS_COMPLETED => trans('panel.status_completed'),
            self::STATUS_DROPPED => trans('panel.status_dropped'),
        ];

        return $labels[$this->status] ?? $this->status;
    }
}
