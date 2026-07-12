<?php

return [
    'limits' => [
        'daily_deposit' => 1000000.00,
        'daily_withdrawal' => 500000.00,
        'maximum_balance' => 10000000.00,
        'maximum_transaction' => 250000.00,
    ],
    'statuses' => [
        'active' => 'active',
        'suspended' => 'suspended',
        'frozen' => 'frozen',
        'closed' => 'closed',
    ],
    'transaction_types' => [
        'deposit' => 'deposit',
        'withdraw' => 'withdraw',
        'escrow_lock' => 'escrow_lock',
        'escrow_release' => 'escrow_release',
        'refund' => 'refund',
        'commission' => 'commission',
        'penalty' => 'penalty',
        'adjustment' => 'adjustment',
        'transfer' => 'transfer',
        'settlement' => 'settlement',
        'reward' => 'reward',
        'bonus' => 'bonus',
    ],
    'ledger_offset_account_id' => env('WALLET_LEDGER_OFFSET_ACCOUNT_ID', null),
];
