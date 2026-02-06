<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::factory()->count(35)->create([
            'category_id' => 1, // 1〜5 など存在するIDを入れる
        ]);
    }
}
