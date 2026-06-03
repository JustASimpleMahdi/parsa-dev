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

        RequestType::create([
            'title' => DefaultRequestTypeNameEnum::LEAVE_REQUEST->value,
            'name' => DefaultRequestTypeNameEnum::LEAVE_REQUEST->name,
            'readonly' => false
        ]);
        RequestType::create([
            'title' => DefaultRequestTypeNameEnum::BROKEN_REPORT->value,
            'name' => DefaultRequestTypeNameEnum::BROKEN_REPORT->name,
            'readonly' => false
        ]);
        RequestType::create([
            'title' => DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->value,
            'name' => DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->name,
            'readonly' => true
        ]);
    }
}
