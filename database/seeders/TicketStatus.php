<?php

namespace Database\Seeders;

use App\Models\TicketStatus as ModelsTicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'Open', 'serial' => 1, 'is_active' => 1],
            ['name' => 'Progress', 'serial' => 2, 'is_active' => 1],
            ['name' => 'Resolved', 'serial' => 3, 'is_active' => 1],
            ['name' => 'Closed', 'serial' => 4, 'is_active' => 1],
        ];

        foreach ($status as $item) {
            if (!ModelsTicketStatus::where('name', $item['name'])->exists()) {
                ModelsTicketStatus::create($item);
            }
        }
    }
}
