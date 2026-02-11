<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('channels')->insert([
            ['id' => 1, 'name' => '自社サイト'],
            ['id' => 2, 'name' => '検索エンジン'],
            ['id' => 3, 'name' => 'SNS'],
            ['id' => 4, 'name' => 'テレビ・新聞'],
            ['id' => 5, 'name' => '友人・知人'],
        ]);
    }
}
