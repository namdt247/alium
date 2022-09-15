<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Frontend;

use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\Business\Frontend\BzArticle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    protected $bzArticle;
    public function __construct()
    {
        parent::__construct();
        $this->bzArticle = new BzArticle();
    }

    public function getAddFaq(){
        return view('frontend.service.customer_service');
    }

    public function postAddFaq(Request $request){
        return response()->json(Common::buildApiResponse([],$this->bzArticle->postAddFaq($request)));
    }

    public function getPaymentGuide(){
        return view('frontend.service.guide_payment');
    }

    public function getListArticle($alias = ''){
        $data = $this->bzArticle->getListArticle($alias);
        return view('frontend.list_article',compact('data'));
    }

    public function getDetailArticle($alias,$atcId){
        $article = $this->bzArticle->getDetailArticle($atcId);
        $data = [
            'article' => $article,
        ];
        if(!isset($article)){
            return redirect()->route('frontend.article.getList');
        }
        elseif($article->atc_alias != $alias){
            return redirect()->route('frontend.article.detail',
                [$article->atc_alias,$article->atc_id]);
        }
        else{
            return view('frontend.detail_article',compact('data'));
        }
    }

    public function getCustomerGuide($alias){
        $data = $this->bzArticle->getStaticPage($alias);
        return view('frontend.service.guide_customer',compact('data'));
    }

    public function getListArticleTag($alias){
        $data = $this->bzArticle->getListArticleTag($alias);
        return view('frontend.list_article_tag',compact('data'));
    }

    public function getStaticPage($alias){
        $data = $this->bzArticle->getStaticPage($alias);
        return view('frontend.static_page',compact('data'));
    }

    public function getShowListRecruitment($alias = ''){
        $data = $this->bzArticle->getListRecruitment($alias);
        return view('frontend.list_recruitment',compact('data'));
    }

    public function getDetailRecruitment($alias,$atcId){
        $recruitment = $this->bzArticle->getDetailRecruitment($atcId);
        $data = [
            'article' => $recruitment,
        ];
        if(!isset($recruitment)){
            return redirect()->route('frontend.recruitment.detail');
        }
        elseif($recruitment->atc_alias != $alias){
            return redirect()->route('frontend.recruitment.detail',
                [$recruitment->atc_alias,$recruitment->atc_id]);
        }
        else{
            return view('frontend.detail_recruitment',compact('data'));
        }
    }
}