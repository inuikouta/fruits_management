<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 中間テーブルの全データを削除
        DB::table('product_season')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // 外部キー制約を無効化
        DB::table('products')->truncate(); // データを削除してIDをリセット
        DB::table('seasons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // 外部キー制約を有効化

        // もしくは条件を指定して削除
        // DB::table('product_season')->where('product_id', 1)->delete();

        echo "中間テーブルのデータを削除しました。\n";
    }
}
