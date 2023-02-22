<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'employee_id')->withDefault();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class)->withDefault();
    }
}
