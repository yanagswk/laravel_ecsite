<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品モデル
 *
 * id       : 商品id (外部キー)
 * name     : 商品名
 * amount   : 金額
 */
class Item extends Model
{
    // protected $table = 'items';
    protected $table = 'new_items';

    protected $fillable = ['name', 'amount'];

    /**
     * CartItemモデルとのリレーション
     * 1(CartItem) 対 1(Item)
     */
    public function cart_items()
    {
        return $this->belongsTo(CartItem::class, 'id', 'item_id');
    }


    /**
     * Commentモデルとのリレーション
     * 1(Item) 対 多(Comment)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'item_id', 'id');
    }
}
