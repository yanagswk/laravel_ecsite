<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品モデル
 *
 * id       : 商品id (外部キー)
 * name     : 商品名
 * amount   : 量
 */
class Item extends Model
{
    protected $fillable = ['name', 'amount'];


    /**
     * CartItemモデルとのリレーション
     * 1(CartItem) 対 1(Item)
     */
    public function cart_items()
    {
        return $this->belongsTo(CartItem::class, 'id', 'item_id');
    }

}
