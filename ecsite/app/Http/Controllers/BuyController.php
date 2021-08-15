<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;                       // 商品カートモデル
use Illuminate\Support\Facades\Auth;    // 認証

use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;

class BuyController extends Controller
{
    /**
     * 購入処理
     */
    public function index()
    {
        $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount')
            ->where('user_id', Auth::id())
            ->join('items', 'items.id', '=', 'cart_items.item_id')
            ->get();
        $subtotal = 0;
        foreach($cartitems as $cartitem) {
            $subtotal += $cartitem->amount * $cartitem->quantity;
        }
        return view('buy/index', ['cartitems'=>$cartitems, 'subtotal'=>$subtotal]);
    }


    /**
     * 郵送先入力の処理
     *
     * @param Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        if ($request->has('post')) {
            // mailクラスとBuyクラスを使って、メールを送信する。
            // Auth::user()->emailでログイン中のユーザーメールアドレス取得
            Mail::to(Auth::user()->email)->send(new Buy());

            CartItem::where('user_id', Auth::id())->delete();
            return view('buy/complete');
        }

        // フォームのリクエスト情報をセッションに記録
        $request->flash();
        // 購入画面のビューを再度表示
        return $this->index();
    }
}
