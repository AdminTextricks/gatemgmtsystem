<?php

namespace Database\Seeders;

use App\Models\VisitorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name'        => 'Pending',
                'description' => 'Visitor arrived without prior intimation; approval required.',
            ],
            [
                'name'        => 'Approved',
                'description' => 'Entry approved by resident/member or created directly by resident.',
            ],
            [
                'name'        => 'Checked In',
                'description' => 'Visitor has entered the society premises.',
            ],
            [
                'name'        => 'Checked Out',
                'description' => 'Visitor has exited the society premises.',
            ],
            [
                'name'        => 'Rejected',
                'description' => 'Resident/Member rejected the visitor request.',
            ],
        ];

        foreach ($statuses as $status) {
            VisitorStatus::create($status);
        }
    }
}
