<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     */
    public function definition(): array
    {
        $genders = [1, 2, 3];

        // 日本の姓と名のサンプル
        $lastNames = ['山田', '佐藤', '鈴木', '高橋', '田中', '渡辺', '伊藤', '中村', '小林', '加藤'];
        $firstNamesMale = ['太郎', '次郎', '三郎', '健', '誠', '大輔', '翔', '拓也', '優', '隼人'];
        $firstNamesFemale = ['花子', '美咲', 'さくら', '愛', '結衣', '陽菜', '葵', '凛', '美優', '彩'];

        $gender = $this->faker->randomElement($genders);
        $lastName = $this->faker->randomElement($lastNames);
        $firstName = $gender == 1
            ? $this->faker->randomElement($firstNamesMale)
            : $this->faker->randomElement($firstNamesFemale);
        $inquiries = [
            '先日注文した商品がまだ届いていません。配送状況を教えていただけますでしょうか。',
            '商品のサイズ交換をお願いしたいのですが、可能でしょうか？',
            '届いた商品に傷がついていました。交換をお願いできますか。',
            '注文をキャンセルしたいのですが、まだ可能でしょうか。',
            '商品の色について詳しく教えていただきたいです。',
            '返品の手続きについて教えてください。',
            '在庫の有無を確認したいです。いつ頃入荷予定でしょうか。',
            'ギフト包装は可能ですか？また、料金はかかりますか。',
            '領収書の発行をお願いしたいのですが、可能でしょうか。',
            '配送先の住所を変更したいです。どうすればよいでしょうか。',
            '商品の使い方がわからないので、詳しく教えていただけますか。',
            'セール商品は返品できますか？',
            'ポイントの利用方法について教えてください。',
            '会員登録の変更方法を教えてください。',
            '商品について電話で相談したいのですが、可能でしょうか。',
            '支払い方法の変更は可能ですか？',
            '注文確認メールが届きません。確認できますか。',
            '商品の詳細な寸法を教えていただけますか。',
            '再入荷の通知メールを受け取りたいです。',
            '複数購入の割引はありますか？',
        ];

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $gender,
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => '0' . $this->faker->numberBetween(70, 90) . '-' . 
                     $this->faker->numberBetween(1000, 9999) . '-' . 
                     $this->faker->numberBetween(1000, 9999),
            'address' => $this->faker->city() . $this->faker->streetAddress(),
            'building' => $this->faker->optional(0.7)->secondaryAddress(),
            'detail' => $this->faker->randomElement($inquiries),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => now(),
        ];
    }
}
