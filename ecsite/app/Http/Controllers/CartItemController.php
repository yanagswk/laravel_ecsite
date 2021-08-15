<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CartItem;
use App\Http\Requests\CartItemRequest;

class CartItemController extends Controller
{
    /**
     * カートに商品を追加したり、数量を変更する
     * updateOrCreateメソッドで登録か更新をする。
     *
     * @method post
     * @param Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        // `user_idとitem_idが一致するレコードがすでに存在していた場合は、
        // quantity(数量)を加算し、レコードが存在していなければ新規登録する。
        CartItem::updateOrCreate([
            'user_id' => Auth::id(),
            'item_id' => $request->post('item_id'),
        ], [
            'quantity' => \DB::raw('quantity + ' . $request->post('quantity'))
        ]);
        return redirect('/')->with('flash_message', 'カートに追加しました');
    }


    /**
     * カート内の商品データを読み込む
     *
     * 商品名(name)と商品の値段(amount)は、
     * 1対１のリレーションを組んだitemsプロパティにアクセス
     *
     * @method get
     */
    public function index()
    {
        // Itemモデルとリレーションを組まなかった場合
        // $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount')
        //     ->where('user_id', Auth::id())
        //     ->join('items', 'items.id', '=', 'cart_items.item_id')
        //     ->get();

        // カート内の商品データを読み込む
        $cartitems = CartItem::where('user_id', Auth::id())->get();
        // foreach ($carts as $cart) {
        //     $test = $cart->items->name;
        //     dd($test);
        // }

        $subtotal = 0;
        // カート内の商品の合計を計算
        foreach($cartitems as $cartitem) {
            $subtotal += $cartitem->items->amount * $cartitem->quantity;
        }

        return view('cartitem/index', ['cartitems'=>$cartitems, 'subtotal'=>$subtotal]);
    }


    /**
     * カート内の商品を削除する
     *
     * @method put
     * @param CartItem $cartItem カートの商品情報
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect('cartitem')->with('flash_message', 'カートから削除しました。');
    }


    /**
     * カート内の商品を編集する
     *
     * @method delete
     * @param App\Http\Requests\CartItemRequest
     * @param CartItem カートの商品情報
     */
    public function update(CartItemRequest $request, CartItem $cartItem)
    {
        $cartItem->quantity = $request->post('quantity');
        $cartItem->save();
        return redirect('cartitem')->with('flash_message', 'カートから更新しました。');
    }
}
