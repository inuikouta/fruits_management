<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRegister;
use App\Http\Requests\ProductUpdate;

class ProductSeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // モデルからデータを取得
        $products = Product::paginate(6);
        // ビューにデータを渡す
        return view('productList', ['products' => $products]);
    }

    /**
     * 検索
     *
     * @param $request
     * @return void
     */
    public function search(Request $request)
    {
        $products = Product::searchProductByWord($request);

        if ($request->input('price_sort')) {
            if ($request->input('price_sort') == 'desc') {
                $sort = "高い順に表示";
            } elseif ($request->input('price_sort') == 'asc') {
                $sort = "安い順に表示";
            }
            // ビューにデータを渡す
            return view('productList', ['products' => $products, "price_sort" => $sort]);
        }

        // ビューにデータを渡す
        return view('productList', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRegister $request)
    {
        Product::registerProduct($request->all());
        // データ登録
        return redirect()->route('product.index')->with('success', '商品を登録しました');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 商品IDを元に商品情報を取得
        $product = product::getProductById($id);

        // 季節
        $season_array = [];
        $seasons = $product->seasons;
        foreach ($seasons as $season) {
            array_push($season_array, $season->id);
        }

        // 商品情報をビューに渡す
        return view('productDetail', ['product' => $product, 'seasons' => $season_array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, $id)
    {
        Product::updateProduct($request->all(), $id);

        return redirect()->route('product.index')->with('success', '商品情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::deleteProduct($id);

        return redirect()->route('product.index')->with('success', '商品を削除しました');
    }
}
