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
                <h4 class="pt-4">@lang('message.newsCate.search') {!! $data['tag']->tag_name !!}</h4>
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