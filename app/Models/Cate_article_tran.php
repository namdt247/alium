<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cate_article_tran
 */
class Cate_article_tran extends Model
{
    public $table = 'cate_article_tran';
    public $timestamps = false;
    public $fillable = ['cate_value','cate_alias'];
}
