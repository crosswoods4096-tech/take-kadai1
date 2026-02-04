<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->numerify('0##########'),
            'address' => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress(),
            'category_id' => $this->faker->numberBetween(1, 5),
            'content' => $this->faker->randomElement([
                '商品の詳細について教えてください。',
                '注文内容を変更したいのですが可能でしょうか。',
                '配送予定日を確認したいです。',
                '支払い方法について質問があります。',
                'キャンセルを希望しています。',
                '見積もりをお願いできますか。',
            ]),
        ];
    }
}
