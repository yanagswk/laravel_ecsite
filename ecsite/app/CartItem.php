<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品カート用のモデル
 *
 * id       : id
 * user_id  : ユーザーid
 * item_id  : 商品id
 * quantity : 量
 */
class CartItem extends Model
{
    // protected $table = 'cart_items';
    protected $table = 'new_cart_items';

    // 登録可能なカラム指定
    protected $fillable = ['user_id', 'item_id', 'quantity'];


    /**
     * Itemモデルとのリレーション
     * 1(CartItem) 対 1(Item)
     */
    public function items()
    {
        // return $this->hasMany(Item::class, 'id', 'id');
        return $this->hasOne(Item::class, 'id', 'item_id');
    }


}
