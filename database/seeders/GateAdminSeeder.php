<?php

namespace Database\Seeders;

use App\Models\GateAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gate_admin_data=[
            "gate_admin_id" => "GAD001",
            "name" => "himanshu",
            "email" => "himanshu@gmail.com",
            "mobile" => "8010221068",
            "device_id" => "MDID001",
            "gate_no" => "4",
            "shift" => "Day",
            "status" => "1",
        ];

        GateAdmin::create($gate_admin_data);
    }
}
