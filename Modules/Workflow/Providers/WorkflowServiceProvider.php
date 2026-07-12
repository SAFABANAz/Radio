<?php

namespace Modules\Workflow\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Workflow\Repositories\Eloquent\WorkflowRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowInstanceRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowStepRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowApprovalRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowActionRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowTransitionRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowConditionRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowAssignmentRepository;
use Modules\Workflow\Repositories\Eloquent\WorkflowVersionRepository;
use Modules\Workflow\Repositories\Interfaces\WorkflowRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowInstanceRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowStepRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowApprovalRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowActionRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowTransitionRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowConditionRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowAssignmentRepositoryInterface;
use Modules\Workflow\Repositories\Interfaces\WorkflowVersionRepositoryInterface;
use Modules\Workflow\Services\WorkflowService;
use Modules\Workflow\Services\WorkflowEngineService;
use Modules\Workflow\Services\WorkflowExecutionService;
use Modules\Workflow\Services\WorkflowApprovalService;
use Modules\Workflow\Services\WorkflowActionService;
use Modules\Workflow\Services\WorkflowConditionService;

class WorkflowServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/workflow.php', 'workflow');

        $this->app->bind(WorkflowRepositoryInterface::class, WorkflowRepository::class);
        $this->app->bind(WorkflowInstanceRepositoryInterface::class, WorkflowInstanceRepository::class);
        $this->app->bind(WorkflowStepRepositoryInterface::class, WorkflowStepRepository::class);
        $this->app->bind(WorkflowApprovalRepositoryInterface::class, WorkflowApprovalRepository::class);
        $this->app->bind(WorkflowActionRepositoryInterface::class, WorkflowActionRepository::class);
        $this->app->bind(WorkflowTransitionRepositoryInterface::class, WorkflowTransitionRepository::class);
        $this->app->bind(WorkflowConditionRepositoryInterface::class, WorkflowConditionRepository::class);
        $this->app->bind(WorkflowAssignmentRepositoryInterface::class, WorkflowAssignmentRepository::class);
        $this->app->bind(WorkflowVersionRepositoryInterface::class, WorkflowVersionRepository::class);

        $this->app->singleton(WorkflowService::class, fn ($app) => new WorkflowService($app->make(WorkflowRepositoryInterface::class), $app->make(WorkflowVersionRepositoryInterface::class)));
        $this->app->singleton(WorkflowEngineService::class, fn ($app) => new WorkflowEngineService(
            $app->make(WorkflowInstanceRepositoryInterface::class),
            $app->make(WorkflowStepRepositoryInterface::class),
            $app->make(WorkflowTransitionRepositoryInterface::class),
            $app->make(WorkflowConditionRepositoryInterface::class),
            $app->make(WorkflowActionService::class)
        ));
        $this->app->singleton(WorkflowExecutionService::class, fn ($app) => new WorkflowExecutionService(
            $app->make(WorkflowInstanceRepositoryInterface::class),
            $app->make(WorkflowStepRepositoryInterface::class),
            $app->make(WorkflowApprovalService::class),
            $app->make(WorkflowActionService::class)
        ));
        $this->app->singleton(WorkflowApprovalService::class, fn ($app) => new WorkflowApprovalService(
            $app->make(WorkflowApprovalRepositoryInterface::class),
            $app->make(WorkflowInstanceRepositoryInterface::class),
            $app->make(WorkflowEngineService::class)
        ));
        $this->app->singleton(WorkflowActionService::class, fn ($app) => new WorkflowActionService(
            $app->make(WorkflowActionRepositoryInterface::class)
        ));
        $this->app->singleton(WorkflowConditionService::class, fn ($app) => new WorkflowConditionService(
            $app->make(WorkflowConditionRepositoryInterface::class)
        ));
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
