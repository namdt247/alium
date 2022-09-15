<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\DAL;

use App\Models\Article;
use App\Models\Cate_article;
use App\Models\Taggable;

class DAL_Article
{
    protected $sumField;
    protected $articleStatus = [1];

    public function __construct(){
        $this->sumField = [
            'atc_id','atc_featureImg',
            'atc_title','atc_sapo','atc_createdBy',
            'atc_alias',
            'atc_view', 'atc_cate', 'atc_status',
            'created_at',
            'atc_content',
            'atc_publicDate'
        ];
    }

    #region *** ARTICLE ***
    public function getNewestArticle($num=4){
        return $this->getListArticle([DAL_Config::ARTICLE_STATUS_PUBLIC],'created_at','desc',$num);
    }

    public function getMostViewArticle($num=4){
        return $this->getListArticle([DAL_Config::ARTICLE_STATUS_PUBLIC],'atc_view','desc',$num);
    }

    public function getListPromoteArticle($cateId){
        $query = Article::where('atc_status',1)
            ->where('atc_promote',1)->where('atc_type',1);
        if ($cateId && $cateId > 0)
            $query = $query->where('atc_cate',$cateId);
        return $query->orderBy('created_at','desc')->take(3)->get();
    }

    public function getRelatedArticle($article){
        return Article::where('atc_id','!=',$article->atc_id)
            ->where('atc_cate',$article->atc_cate)->where('atc_type',1)
            ->orderBy('created_at','desc')
            ->take(3)->get();
    }

    public function getListArticle($status, $order = 'created_at',$desc = 'desc',$num = DAL_Config::NUM_PER_PAGE_ARTICLE){
        return Article::whereIn('atc_status',$status)
            ->where('atc_type',1)
            ->orderBy($order, $desc)
            ->select($this->sumField)
            ->with(['cate_article','author'])
            ->paginate($num);
    }

    public function getListArticleByCate($lstCate,$num = DAL_Config::NUM_PER_PAGE_ARTICLE){
        return Article::whereIn('atc_status',$this->articleStatus)
            ->where('atc_type',1)
            ->whereIn('atc_cate',$lstCate)
            ->orderBy('created_at', 'desc')
            ->with(['cate_article','author'])
            ->select($this->sumField)
            ->paginate($num);
    }

    public function getDetailArticle($atcId){
        return Article::where('atc_id',$atcId)->with(['cate_article','author'])->first();
    }

    public function createArticle($data = array()){
        return Article::create($data);
    }

    public function updateArticle($atcId = 1, $data = array()){
        return Article::where('atc_id',$atcId)->update($data);
    }
    #endregion

    #region *** Recruitment ***
    public function getListPromoteRecruitment($cateId){
        $query = Article::where('atc_status',1)
            ->where('atc_promote',1)->where('atc_type',3);
        if ($cateId && $cateId > 0)
            $query = $query->where('atc_cate',$cateId);
        return $query->orderBy('created_at','desc')->take(3)->get();
    }

    public function getRelatedRecruitment($article){
        return Article::where('atc_id','!=',$article->atc_id)
            ->where('atc_cate',$article->atc_cate)->where('atc_type',3)
            ->orderBy('created_at','desc')
            ->take(3)->get();
    }

    public function getDetailRecruitment($atcId){
        return Article::where('atc_id',$atcId)->with(['cate_article','author'])->first();
    }
    #endregion

    #region *** Question and Answer ***
    public function getListQNA(){

    }

    public function getListQNAByCate($lstCate, $num = DAL_Config::NUM_PER_PAGE_ARTICLE){
        return Article::whereIn('atc_status',$this->articleStatus)
            ->where('atc_type',2)
            ->whereIn('atc_cate',$lstCate)
            ->orderBy('created_at', 'desc')
            ->select($this->sumField)
            ->paginate($num);
    }
    #endregion


    #region *** CATE ARTICLE ***
    public function getDetailCateArticle($cate){
        return Cate_article::where('cate_id',$cate)->orWhere('cate_alias',$cate)->first();
    }

    public function getCateByAlias($cateAlias){
        return Cate_article::where('cate_alias',$cateAlias)->first();
    }

    public function getListCateArticle($status){
        return Cate_article::whereIn('cate_status',$status)->get();
    }

    public function getListCateAjax($order,$direct,$num){
        return Cate_article::whereIn('cate_status',[1])
            ->orderBy($order,$direct)->paginate($num);
    }

    public function getListCatePublic(){
        return $this->getListCateArticle([1]);
    }

    public function createCateArticle($array){
        return Cate_article::create($array);
    }

    public function updateCateArticle($cateId = 1, $data = array()){
        return Cate_article::where('cate_id', $cateId)
            ->update($data);
    }
    #endregion

    public function getListArticleByTag($tagId){
        return Taggable::join('article','article.atc_id','=','taggable.tga_id')
            ->where('tga_tag',$tagId)->get();
    }
}