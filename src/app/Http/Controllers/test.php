<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class test extends Controller
{
    public function test()
    {
        // IDが1のSeasonを取得
        $season = Season::find(1);

        // 関連するProduct（製品）を取得
        $products = $season->products;

        echo 'Season Name: ' . $season->name . '<br>'; // 季節名
        // 各Productのpriceを表示
        foreach ($products as $product) {
            echo 'Product Name: ' . $product->name . '<br>'; // 製品名
            echo 'Price: ' . $product->price . '<br>';       // 製品の価格
        }
    }
}
