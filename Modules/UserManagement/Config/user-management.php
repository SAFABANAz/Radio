<?php

return [
    'name' => 'user-management',
    'default_guard' => 'web',
    'models' => [
        'user' => App\Models\User::class,
        'profile' => Modules\UserManagement\Models\UserProfile::class,
        'setting' => Modules\UserManagement\Models\UserSetting::class,
        'bank_account' => Modules\UserManagement\Models\UserBankAccount::class,
        'activity_log' => Modules\UserManagement\Models\ActivityLog::class,
    ],
];
