<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    // public $timestamps = false;
    protected $table = 'projects';
    protected $guarded = ['id'];

    // Constants
    const FIELD_TRAINING = 'training';
    const FIELD_CONSULTING = 'consulting';
    const FIELD_OTHER_SERVICES = 'other_services';

    const VENUE_HOTEL = 'hotel';
    const VENUE_CLIENT_VENUE = 'client_venue';
    const VENUE_CENTER_VENUE = 'center_venue';

    const LOGISTICS_COFFEE_BREAK = 'coffee_break';
    const LOGISTICS_LUNCH = 'lunch';
    const LOGISTICS_OTHER = 'other';

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // Relationships
    public function organization()
    {
        return $this->belongsTo('App\User', 'organization_id', 'id');
    }

    public function projectManager()
    {
        return $this->belongsTo('App\User', 'project_manager_id', 'id');
    }

    public function projectCoordinator()
    {
        return $this->belongsTo('App\User', 'project_coordinator_id', 'id');
    }

    public function projectConsultant()
    {
        return $this->belongsTo('App\User', 'project_consultant_id', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\ProjectFile', 'project_id', 'id');
    }

    public function webinars()
    {
        return $this->belongsToMany('App\Models\Webinar', 'project_webinars', 'project_id', 'webinar_id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\User', 'project_participants', 'project_id', 'user_id');
    }

    // Accessors
    public function getFieldLabelAttribute()
    {
        $labels = [
            self::FIELD_TRAINING => trans('panel.training'),
            self::FIELD_CONSULTING => trans('panel.consulting'),
            self::FIELD_OTHER_SERVICES => trans('panel.other_services'),
        ];

        return $labels[$this->field] ?? $this->field;
    }

    public function getVenueTypeLabelAttribute()
    {
        $labels = [
            self::VENUE_HOTEL => trans('panel.hotel'),
            self::VENUE_CLIENT_VENUE => trans('panel.client_venue'),
            self::VENUE_CENTER_VENUE => trans('panel.center_venue'),
        ];

        return $labels[$this->venue_type] ?? $this->venue_type;
    }

    public function getLogisticsServicesLabelAttribute()
    {
        $labels = [
            self::LOGISTICS_COFFEE_BREAK => trans('panel.coffee_break'),
            self::LOGISTICS_LUNCH => trans('panel.lunch'),
            self::LOGISTICS_OTHER => trans('panel.other'),
        ];

        return $labels[$this->logistics_services] ?? $this->logistics_services;
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_DRAFT => trans('panel.draft'),
            self::STATUS_ACTIVE => trans('panel.active'),
            self::STATUS_COMPLETED => trans('panel.completed'),
            self::STATUS_CANCELLED => trans('panel.cancelled'),
        ];

        return $labels[$this->status] ?? $this->status;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeByOrganization($query, $organizationId)
    {
        return $query->where('organization_id', $organizationId);
    }

    // Methods
    public function getWebinarsCountAttribute()
    {
        return $this->webinars()->count();
    }

    public function getParticipantsCountAttribute()
    {
        return $this->participants()->count();
    }

    public function generateSlug()
    {
        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $counter = 1;

        while (self::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = $project->generateSlug();
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('name') && empty($project->slug)) {
                $project->slug = $project->generateSlug();
            }
        });
    }
} 