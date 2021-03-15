<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'project_id'
    ];
}
