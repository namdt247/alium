<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-07-07
 * Time: 10:18
 */
?>

@extends('frontend.layout_master')

@section('main-content')
    <div class="content">
        <div class="container">
            <div class="tab-news">
                <a href="{!! route('frontend.article.getList') !!}"
                    @if(Route::current()->getName() == 'frontend.article.getList') class="active" @endif
                >@lang('message.header.newsCate')</a>
                <?php $cateArticle = \App\Models\Cate_article::find(1); ?>
                @if($cateArticle && $cateArticle->cate_id)
                    <a href="{!! route('frontend.article.getListByCate',$cateArticle->cate_alias) !!}"
                       @if(Route::current()->getName() == 'frontend.article.getListByCate') class="active" @endif
                        >@lang('message.footer.newsAlium-Er')</a>
                @endif
            </div>
        </div>
        <div class="feature-news">
            <div class="container">
                <div class="row">
                    @if(count($data['lstPromote']) > 0)
                        <?php $promoteAtc = $data['lstPromote'][0] ?>
                    <div class="col-md-6 mb-3">
                        <div class="promote-item d-flex">
                            <a href="{!! route('frontend.article.detail',[$promoteAtc->atc_alias,$promoteAtc->atc_id]) !!}">
                                <img class="img-fluid"
                                     src="{!! \App\Helper\Common::GetThumb($promoteAtc->atc_featureImg,'c1') !!}"
                                     alt="{!! $promoteAtc->atc_title !!}">
                            </a>
                            <div class="promote-text">
                                <a class="text-link">{!! $promoteAtc->atc_title !!}</a>
                                <span>{!! date('d/m/Y',strtotime($promoteAtc->created_at)) !!}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(count($data['lstPromote']) > 1)
                    <?php $promoteAtc = $data['lstPromote'][1] ?>
                    <div class="col-md-3 mb-3">
                        <div class="promote-item">
                            <a href="{!! route('frontend.article.detail',[$promoteAtc->atc_alias,$promoteAtc->atc_id]) !!}">
                                <img class="img-fluid"
                                     src="{!! \App\Helper\Common::GetThumb($promoteAtc->atc_featureImg,'c1') !!}"
                                     alt="{!! $promoteAtc->atc_title !!}">
                            </a>
                            <a class="text-link">{!! $promoteAtc->atc_title !!}</a>
                            <span>{!! date('d/m/Y',strtotime($promoteAtc->created_at)) !!}</span>
                        </div>
                    </div>
                    @endif
                    @if(count($data['lstPromote']) > 2)
                    <?php $promoteAtc = $data['lstPromote'][2] ?>
                    <div class="col-md-3 mb-3">
                        <div class="promote-item">
                            <a href="{!! route('frontend.article.detail',[$promoteAtc->atc_alias,$promoteAtc->atc_id]) !!}">
                                <img class="img-fluid"
                                     src="{!! \App\Helper\Common::GetThumb($promoteAtc->atc_featureImg,'c1') !!}"
                                     alt="{!! $promoteAtc->atc_title !!}">
                            </a>
                            <a class="text-link">{!! $promoteAtc->atc_title !!}</a>
                            <span>{!! date('d/m/Y',strtotime($promoteAtc->created_at)) !!}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="banner-news">
            <div class="container d-flex">
                <p class="news-font-mobile">@lang('message.newsCate.ready')</p>
                <a href="{!! route('frontend.order.getAdd') !!}" class="btn ml-auto">
                    @lang('message.home.feature.produce')
                </a>
            </div>
        </div>
        <div class="list-news">
            <div class="container">
                <div class="row">
                    @foreach($data['lstArticle'] as $article)
                    <div class="col-md-3 news-item">
                        <div class="news-item-wrapper" >
                            <a href="{!! route('frontend.article.detail',[$article->atc_alias,$article->atc_id]) !!}">
                                <img class="img-fluid news-img"
                                     src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg,'c1') !!}"
                                     alt="{!! $article->atc_title !!}">
                            </a>
                            <a class="text-link"
                               href="{!! route('frontend.article.detail',[$article->atc_alias,$article->atc_id]) !!}"
                                >{!! $article->atc_title !!}</a>
                            <p>{!! $article->atc_sapo !!}</p>
                            <div class="d-flex">
                                <span class="d-block">{!! date('d/m/Y',strtotime($article->created_at)) !!}</span>
                                <a href="{!! route('frontend.article.detail',[$article->atc_alias,$article->atc_id]) !!}"
                                   class="read-more">@lang('message.dtArticle.see')
                                    <img src="/img/read-more.png" alt="{!! $article->atc_title !!}">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="center">
                    {!! $data['lstArticle']->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-script')

@endsection