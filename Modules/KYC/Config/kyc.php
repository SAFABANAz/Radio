<?php

return [
    'statuses' => [
        'pending',
        'under_review',
        'need_correction',
        'approved',
        'rejected',
        'expired',
        'cancelled',
    ],

    'required_documents' => [
        'national_id_front',
        'national_id_back',
        'birth_certificate',
        'selfie',
        'commitment_letter',
        'signature_document',
    ],

    'field_validation' => [
        'national_code' => ['required' => true, 'regex' => '/^[0-9]{10}$/', 'unique' => true],
        'postal_code' => ['required' => true, 'regex' => '/^[0-9]{10}$/'],
        'birth_date' => ['required' => true, 'date' => true],
    ],
];
