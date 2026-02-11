<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => '商品のお届けについて'],
            ['id' => 2, 'name' => '商品の交換について'],
            ['id' => 3, 'name' => '商品トラブル'],
            ['id' => 4, 'name' => 'ショップへのお問い合わせ'],
            ['id' => 5, 'name' => 'その他'],
        ];

        Category::insert($categories);
    }
}
