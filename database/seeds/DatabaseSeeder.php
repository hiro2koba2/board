<?php

use Illuminate\Database\Seeder;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        // タグの生成　追加する機能は作らないのでこのまま実行　別のファイルには分けてない
        // $tags = ['フリーWi-Fi', 'キャリアWi-Fi', '電源', 'Suica', 'クレジット'];
        // foreach ($tags as $tag) Tag::create(['name' => $tag]);
    }
}
