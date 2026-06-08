<?php

namespace Database\Seeders;

use App\DefaultRequestTypeNameEnum;
use App\Models\RequestType;
use Illuminate\Database\Seeder;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        RequestType::createQuietly([
            'title' => DefaultRequestTypeNameEnum::LEAVE_REQUEST->value,
            'name' => DefaultRequestTypeNameEnum::LEAVE_REQUEST->name,
            'description' => ' توضیحات درخواست مرخصی(تاریخ ، مدت ، دلیل)...',
            'readonly' => false
        ]);
        RequestType::createQuietly([
            'title' => DefaultRequestTypeNameEnum::BROKEN_REPORT->value,
            'name' => DefaultRequestTypeNameEnum::BROKEN_REPORT->name,
            'description' => 'نوع مشکل ، سیستم مربوطه ، توضیحات کامل...',
            'readonly' => false
        ]);
        RequestType::createQuietly([
            'title' => DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->value,
            'name' => DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->name,
            'description' => 'دلیل استعفا ، هماهنگی های لازم ...',
            'readonly' => true
        ]);
    }
}
