<?php

use App\JobRequestStatusEnum;

return [
    'manager' => [
        'status' => [
            JobRequestStatusEnum::PENDING->value => 'جدید',
            JobRequestStatusEnum::ACCEPTED->value => 'تایید شده',
            JobRequestStatusEnum::REJECTED->value => 'رد شده',
        ]
    ]
];
