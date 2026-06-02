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
        foreach (DefaultRequestTypeNameEnum::cases() as $enum) {
            RequestType::create([
                'title' => $enum->value,
                'name' => $enum->name,
                'readonly' => true
            ]);
        }
    }
}
