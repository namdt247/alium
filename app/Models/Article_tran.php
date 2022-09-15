<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article_tran
 */
class Article_tran extends Model
{
    public $table = 'article_tran';
    public $timestamps = false;
    protected $fillable = ['atc_title','atc_sapo','atc_content','atc_alias','atc_source'];
}
