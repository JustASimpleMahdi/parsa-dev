<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use App\RegisterStatusEnum;
use App\RoleEnum;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '12345678',
            'role' => RoleEnum::MANAGER,
            'register_status' => RegisterStatusEnum::PERSONAL_INFO
        ]);

        $user->personal_info()->create([
            'firstname' => 'محمد',
            'lastname' => 'ایرانی',
            'father_name' => 'نمیدونم',
            'birthdate' => '1382/08/02',
            'birthplace' => 'شیروان',
            'id_number' => '0123456789',
            'national_code' => '0123456789',
            'phone' => '09933456574',
            'address' => 'شیروان',
            'postal_code' => '0123245678',
            'personal_image' => File::create([
                'name' => 'test1',
                'original_name' => 'test1',
                'extension' => 'jpg',
                'mime_type' => 'image/jpeg',
                'size' => 1234,
                'path' => 'test1'
            ])->id,
            'last_degree' => File::create([
                'name' => 'test2',
                'original_name' => 'test2',
                'extension' => 'jpg',
                'mime_type' => 'image/jpeg',
                'size' => 1234,
                'path' => 'test2'
            ])->id
        ]);
    }
}
