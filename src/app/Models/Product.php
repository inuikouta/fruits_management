<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    /**
     * 商品名をデータベースから検索する
     *
     * @param string $word
     * @return \Illuminate\Database\Eloquent\Collection 検索結果のコレクション
     */
    public static function searchProductByWord($request)
    {
        $query = self::where('name', 'LIKE', "%{$request->word}%");

        if ($request->price_sort == 'asc') {
            // 価格が低い順に並び替え
            $query->orderBy('price', 'asc')->get();
        } elseif ($request->price_sort == 'desc') {
            // 価格が高い順に並び替え
            $query->orderBy('price', 'desc')->get();
        } else {
            // デフォルトの並び替え（価格順なし）
            $query->get();
        }

        // ページネーションを追加
        return $query->paginate(6)->appends($request->all());
    }

    /**
     * 商品を全て取り出す
     *
     * @param void
     * @return \Illuminate\Database\Eloquent\Collection 商品のコレクション
     */
    public static function getAllProducts()
    {
        return self::all();
    }

    /**
     * 商品を登録する
     *
     * @param array $data
     * @return void
     */
    public static function registerProduct($data)
    {
        // アップロードされた画像を取得
        $image = $data['product-img'];

        // 画像を保存し、保存先のパスを取得
        $path = $image->store('images/products', 'public');

        // 商品を登録
        $product = new self();
        $product->name = $data['product-name'];
        $product->price = $data['product-price'];
        $product->image = $path;
        $product->description = $data['product-desc'];
        $product->save();

        // 季節の登録
        $product->seasons()->sync($data['product-season']);
    }

    /**
     *  IDを指定して商品を取得
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection 商品のコレクション
     */
    public static function getProductById($id)
    {
        return self::with('seasons')->where('id', $id)->first();
    }

    /**
     * 商品を更新する
     *
     * @param int $id
     * @param array $data
     * @return void
     */
    public static function updateProduct($data, $id)
    {
        // 商品をIDで取得
        $product = Product::findOrFail($id);

        $product->seasons()->sync($data['product-season']);
        $product->name = $data['product-name'];
        $product->price = $data['product-price'];
        $product->description = $data['product-desc'];

        // アップロードされた画像を取得
        if (isset($data['product-img'])) {
            // 古い画像の削除
            if ($data['product-img'] && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $image = $data['product-img'];
            // 画像を保存し、保存先のパスを取得
            $path = $image->store('images/products', 'public');
            $product->image = $path;
        }

        // 商品を更新
        $product->save();
    }

    /**
     * 商品を削除する
     *
     * @param int $id
     * @return void
     */
    public static function deleteProduct($id)
    {
        // 商品をIDで取得
        $product = Product::findOrFail($id);

        // 古い画像の削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // 商品を削除
        $product->delete();
    }
}
