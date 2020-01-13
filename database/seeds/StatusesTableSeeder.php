<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'draft']);
        Status::create(['name' => 'sent']);
        Status::create(['name' => 'paid']);
        Status::create(['name' => 'overdue']);
        Status::create(['name' => 'canceled']);
        Status::create(['name' => 'write-off']);
    }
}
