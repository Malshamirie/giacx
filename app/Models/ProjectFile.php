<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $table = 'project_files';
    protected $guarded = ['id'];
    public $timestamps = false;

    static $Active = 'active';
    static $Inactive = 'inactive';
    static $fileStatus = ['active', 'inactive'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    public function getFileUrlAttribute()
    {
        return url($this->file_path);
    }

    public function getFileSizeFormattedAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getDownloadUrl()
    {
        return "/panel/projects/files/{$this->id}/download";
    }

    public function getFileSize()
    {
        $size = null;

        $file_path = public_path($this->file_path);

        if (file_exists($file_path)) {
            $size = formatSizeUnits(filesize($file_path));
        }

        return $size;
    }

    public function getIconByType($type = null)
    {
        $icon = 'file';

        if (empty($type)) {
            $type = $this->file_type;
        }

        if (!empty($type)) {
            if (in_array($type, ['pdf', 'powerpoint', 'document'])) {
                $icon = 'file-text';
            } else if (in_array($type, ['sound'])) {
                $icon = 'volume-2';
            } else if (in_array($type, ['video'])) {
                $icon = 'film';
            } else if (in_array($type, ['image'])) {
                $icon = 'image';
            } else if (in_array($type, ['archive'])) {
                $icon = 'archive';
            }
        }

        return $icon;
    }
} 