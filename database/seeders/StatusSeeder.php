<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Pending', 'Processing', 'Canceled', 'Shipped'];
        foreach ($status as $item) {
            $new = new Status();
            $new->status = $item;
            $new->save();
        }
    }
}
