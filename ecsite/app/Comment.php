<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'new_comment';

    protected $fillable = ['body', 'item_id', 'user_id', 'good', 'bad', 'del_flg'];


    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }



}
