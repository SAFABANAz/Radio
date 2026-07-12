<?php

namespace Modules\Workflow\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Shared\Base\BaseModel;

class WorkflowDefinition extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'workflow_definitions';

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    public function steps()
    {
        return $this->hasMany(WorkflowStep::class)->orderBy('step_number');
    }

    public function versions()
    {
        return $this->hasMany(WorkflowVersion::class);
    }

    public function transitions()
    {
        return $this->hasMany(WorkflowTransition::class);
    }

    public function actions()
    {
        return $this->hasMany(WorkflowAction::class);
    }

    public function conditions()
    {
        return $this->hasMany(WorkflowCondition::class);
    }

    public function instances()
    {
        return $this->hasMany(WorkflowInstance::class);
    }
}
