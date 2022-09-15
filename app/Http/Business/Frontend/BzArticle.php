<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:54 CH
 */

namespace App\Http\Business\Frontend;


use App\Helper\_ApiCode;
use App\Helper\Common;
use App\Http\DAL\DAL_Config;
use App\Models\Article;
use App\Models\Cate_article;
use App\Models\Config;
use App\Models\Feedback;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class BzArticle extends BzFrontend
{
    public function postAddFaq($request){
        try {
            $dataFb = [
                'fb_email' => $request->email,
                'fb_phone' => $request->phone,
                'fb_name' => $request->name,
                'fb_order' => $request->order,
                'fb_cate' => $request->cate,
                'fb_content' => $request->content,
            ];
            if (Auth::check()) $dataFb['fb_user'] = Auth::user()->user_id;
            if (Feedback::create($dataFb)) {
                return _ApiCode::SUCCESS;
            }
            return _ApiCode::ERROR_UNKNOWN;
        } catch (\Exception $e) {
            //log exception
            activity()->performedOn(Feedback::getModel())
                ->log("line ".$e->getLine()." file ".$e->getFile() ."\n".$e->getMessage());
            \Log::error($e->getMessage(),$e->getTrace());
            return _ApiCode::ERROR_UNKNOWN;
        }
    }

    public function getListArticle($alias){
        $queryPromote = Article::where('atc_status',1)
            ->where('atc_promote',1)->where('atc_type',1);
        $queryArticle = Article::where('atc_status',1)->where('atc_type',1);

        if ($alias){
            $cate = Cate_article::where('cate_alias',$alias)->first();
            if ($cate && $cate->cate_id){
                $queryPromote = $queryPromote->where('atc_cate',$cate->cate_id);
                $queryArticle = $queryArticle->where('atc_cate',$cate->cate_id);
            }
        }

        $queryPromote = $queryPromote->orderBy('updated_at','desc')->take(3);
        $lstPromoteId = $queryPromote->pluck('atc_id');
        $queryArticle = $queryArticle->whereNotIn('atc_id',$lstPromoteId)
            ->orderBy('created_at','desc');

        $lstPromote = $queryPromote->get();
        $lstArticle = $queryArticle->paginate(8);


        return [
            'lstPromote' => $lstPromote,
            'lstArticle' => $lstArticle,
        ];
    }

    public function getDetailArticle($atcId){
        $article = $this->dal_article->getDetailArticle($atcId);
        $article->atc_view = $article->atc_view + 1;
        $article->save();
        \SEO::setTitle($article->atc_title);
        \SEO::setDescription($article->atc_sapo);
        \SEO::addImages(Common::GetThumb($article->atc_featureImg));
        return $article;
    }

    public function getListArticleTag($alias){
        $tag = Tag::finds($alias);
        return[
            'tag' => $tag,
            'lstArticle' => $tag->articles()->paginate(8)
        ];
    }

    public function getStaticPage($alias){
        $config = Config::where('cfg_alias',$alias)->first();
        if (!$config) $config = Config::find(100);
        return[
            'alias' => $alias,
            'config' => array_values(DAL_Config::getConfigByLocale($config->cfg_id))[0]
        ];
    }

    public function getListRecruitment($alias){
        $queryRecruitment = Article::where('atc_status',1)->where('atc_type',3);

        if ($alias){
            $cate = Cate_article::where('cate_alias',$alias)->first();
            if ($cate && $cate->cate_id){
                $queryRecruitment = $queryRecruitment->where('atc_cate',$cate->cate_id);
            }
        }
        $queryRecruitment = $queryRecruitment->orderBy('created_at','desc');

        $lstRecruitment = $queryRecruitment->paginate();

        return [
            'lstRecruitment' => $lstRecruitment,
        ];
    }

    public function getDetailRecruitment($atcId){
        $recruitment = $this->dal_article->getDetailRecruitment($atcId);
        $recruitment->atc_view = $recruitment->atc_view + 1;
        $recruitment->save();
        \SEO::setTitle($recruitment->atc_title);
        \SEO::setDescription($recruitment->atc_sapo);
        \SEO::addImages(Common::GetThumb($recruitment->atc_featureImg));
        return $recruitment;
    }
}