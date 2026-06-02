<?php

namespace App;

enum JobRequestStatusEnum: string
{
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
}
