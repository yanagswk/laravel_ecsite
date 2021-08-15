<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * 商品一覧表示画面
     * ページネーションを使って15件まで表示
     * Requestは検索機能を使った場合にリクエストされる
     * @method get
     * @param Illuminate\Http\Request $request getで渡ってきたリクエスト
     */
    public function index(Request $request)
    {
        // requestパラメータにkeywordが入っていたら、検索機能を動かす
        if ($request->has('keyword')) {
            // SQLのlike句でitemsテーブルを検索する
            $items = Item::where(
                'name',
                'like',
                '%' . $request->get('keyword') . '%'
            )->paginate(15);
        } else {
            // 一覧表示
            $items = Item::paginate(15);
        }

        return view('item/index', ['items' => $items]);
    }


    /**
     * 商品詳細ページ
     *
     * @method get
     * @param App\Item $item
     */
    public function show(Item $item)
    {
        return view('item/show', ['item'=>$item]);
    }
}
