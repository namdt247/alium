
@extends('frontend.layout_master')

@section('main-content')
    <div class="content">
        <div class="list-news">
            <div class="container">
                <div class="row">
                    @foreach($data['lstRecruitment'] as $article)
                    <div class="col-md-3 news-item">
                        <div class="news-item-wrapper" >
                            <a href="{!! route('frontend.recruitment.detail',[$article->atc_alias,$article->atc_id]) !!}">
                                <img class="img-fluid news-img"
                                     src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg,'c1') !!}"
                                     alt="{!! $article->atc_title !!}">
                            </a>
                            <a class="text-link"
                               href="{!! route('frontend.recruitment.detail',[$article->atc_alias,$article->atc_id]) !!}"
                                >{!! $article->atc_title !!}</a>
                          
                            <div class="d-flex">
                                <span class="d-block">{!! date('d/m/Y',strtotime($article->created_at)) !!}</span>
                                <a href="{!! route('frontend.recruitment.detail',[$article->atc_alias,$article->atc_id]) !!}"
                                   class="read-more">@lang('message.dtArticle.see')
                                    <img src="/img/read-more.png" alt="{!! $article->atc_title !!}">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@section('main-script')

@endsection