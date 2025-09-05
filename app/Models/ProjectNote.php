<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNote extends Model
{
    use HasFactory;

    protected $table = 'project_notes';
    protected $guarded = ['id'];

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
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Accessors
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->format('d/m/Y H:i');
    }
}
