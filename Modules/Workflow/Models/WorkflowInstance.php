<?php

namespace Modules\Workflow\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Shared\Base\BaseModel;

class WorkflowInstance extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'workflow_instances';

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function workflowDefinition()
    {
        return $this->belongsTo(WorkflowDefinition::class);
    }

    public function currentStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'current_step_id');
    }

    public function approvals()
    {
        return $this->hasMany(WorkflowApproval::class);
    }

    public function logs()
    {
        return $this->hasMany(WorkflowLog::class);
    }

    public function events()
    {
        return $this->hasMany(WorkflowEvent::class);
    }

    public function instanceSteps()
    {
        return $this->hasMany(WorkflowInstanceStep::class);
    }
}
