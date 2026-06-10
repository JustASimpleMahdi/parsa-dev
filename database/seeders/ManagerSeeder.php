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
            'firstname' => 'مبین',
            'lastname' => 'یزدانی',
            'father_name' => 'محمد',
            'birthdate' => '1362/04/02',
            'birthplace' => 'بجنورد',
            'id_number' => '0123456789',
            'national_code' => '0123456789',
            'phone' => '09933456574',
            'address' => 'بجنورد - شریعتی 2 - پلاک 16',
            'postal_code' => '0123245678',
            'personal_image_file_id' => File::create([
                'name' => 'test1',
                'original_name' => 'test1',
                'extension' => 'jpg',
                'mime_type' => 'image/jpeg',
                'size' => 1234,
                'path' => 'test1'
            ])->id,
            'last_degree_file_id' => File::create([
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
