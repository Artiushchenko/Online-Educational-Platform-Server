<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chat_rooms')->insert([
            'name' => 'General'
        ]);

        DB::table('chat_rooms')->insert([
            'name' => 'Tech Talk'
        ]);
    }
}
