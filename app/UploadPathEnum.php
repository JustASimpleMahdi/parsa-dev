<?php

namespace App;

enum UploadPathEnum: string
{
    case PERSONAL_IMAGE = 'personal-image';
    case LAST_DEGREE = 'last-degree';
    case RESUME = 'resume';
}
