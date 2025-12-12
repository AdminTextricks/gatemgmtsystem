<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Member::create([
            'name'      => 'Vivek Singh',
            'email'     => 'viveksingh@textricks.com',
            'phone'     => '8039421087',
            'uid'       => 'UID123456',
            'device_id' => 'DEVICE98765',
        ]);

    
    }
}
