<?php

namespace App;

enum RequestStatusEnum: string
{
    case PENDING = 'pending';
    case RESPONDED = 'responded';
}
