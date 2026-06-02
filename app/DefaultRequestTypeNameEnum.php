<?php

namespace App;

enum DefaultRequestTypeNameEnum: string
{
    case LEAVE_REQUEST = 'درخواست مرخصی';
    case BROKEN_REPORT = 'گزارش خرابی';
    case RESIGNATION_REQUEST = 'درخواست استعفا';
}
