<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Constants\Consts;

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
    // public function show(Item $item, $item_id)
    public function show(Item $item)
    {
        // 商品に対するコメント取得
        $comments = $item->comments()->get();

        return view('item/show', ['item'=>$item, 'comments'=>$comments]);
    }


    /**
     * 商品更新処理
     *
     * @method post
     * @param
     */
    public function update(Request $request, $item_id)
    {
        $item = Item::find($item_id);

        $update_message = Consts::UPDATE_MSG;

        // 商品名が変更されてるか
        if (!strcmp($item->name, $request->item_name) == 0) {
            $update_message .= "「{$request->item_name}」";
        }

        // 金額が変更されてるか
        if ($item->amount !== (int) $request->item_amount) {
            $update_message .= "「{$request->item_amount}円」";
        }

        // 何も変更がない場合
        if ($update_message === Consts::UPDATE_MSG) {
            return redirect("/item/{$item_id}")
                ->with('flash_message', '更新されていません');
        }

        $item->name = $request->item_name;
        $item->amount = (int) $request->item_amount;
        $item->save();
        return redirect('/')->with('flash_message', $update_message);
    }
}
