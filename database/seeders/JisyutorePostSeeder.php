<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JisyutorePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'title' => '長めゆっくりランしましょう',
                'start_datetime' => '2022-10-01 18:00:00',
                'end_datetime' => '2022-10-01 19:00:00',
                'nearest_station' => '0001',
                'menu_category' => '01',
                'address' => '都筑区東山田１',
                'comment' => '初参加の方も歓迎。ゆるくやってます。',
                'user_id' => 1,
            ],
            [
                'title' => 'アジリティあげます',
                'start_datetime' => '2022-10-02 17:00:00',
                'end_datetime' => '2022-10-02 18:00:00',
                'nearest_station' => '0002',
                'menu_category' => '02',
                'address' => '都筑区東山田２',
                'comment' => 'クイック鍛えたい方ぜひ',
                'user_id' => 2,
            ]
        ];
        DB::table('jisyutore_posts')->insert($params);
    }
}
