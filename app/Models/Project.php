<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function types()
    {
        return $this->belongsToMany(ProjectType::class, 'project_project_type');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'project_partner');
    }
}
