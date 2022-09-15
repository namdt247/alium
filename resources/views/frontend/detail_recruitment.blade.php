
@extends('frontend.layout_master')

@section('main-content')
    <?php $article = $data['article']; ?>
    <?php $dal_article = new \App\Http\DAL\DAL_Article(); ?>
    <div class="content">

        <div class="list-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="article-content">
                            <div class="text-content">
                                <h1>{!! $article->atc_title !!}</h1>
                                <span class="post-date">
                                    @lang('message.dtArticle.author') {!! $article->author->user_showName !!} 
                                    @lang('message.dtArticle.time')
                                    {!! date_format(date_create($article->created_at),'H\hi, d/m/Y') !!}
                                </span>
                                @if($article->atc_featureImg)
                                    <img src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg) !!}"
                                         class="img img-fluid py-2" alt="{!! $article->atc_title !!}">
                                @endif
                                <div class="pt-3" style="color: #656565;">
                                    {!! $article->atc_content !!}
                                </div>
                                <div class="d-flex">
                                <div class="fb-like" data-href="{!! Request::url() !!}"
                                     data-width="" data-layout="button_count" data-action="like" data-size="large"
                                     data-show-faces="true" data-share="true"></div>
                                <div class="ml-auto text-right">
                                    <p class="m-0"><strong>@lang('message.dtArticle.share')</strong></p>
                                    <a class="count_facebook fb-share"
                                       href="https://www.facebook.com/sharer.php?u={!! url()->current() !!}">
                                        <img src="/img/facebook-share.png" alt="@lang('message.dtArticle.shareFb')">
                                    </a>
                                    <a class="count_twitter tw-share" target="_top"
                                       href="https://twitter.com/share?url={!! url()->current() !!}&amp;text={!! $article->atc_title !!}">
                                        <img src="/img/twitter-share.png" alt="@lang('message.dtArticle.shareTw')">
                                    </a>
                                    <a class="d-none" href="#"><img src="/img/insta-share.png" alt="Chia sẻ facebook"></a>
                                </div>
                                </div>
                            </div>
                            <?php $lstTag = $article->tags ?>
                            @if(count($lstTag) > 0)
                            <div class="tag">
                                @foreach($lstTag as $tag)
                                    <a href="{!! route('frontend.article.getTag',$tag->tag_alias) !!}"
                                       class="tag-item" rel="tag">
                                        {!! $tag->tag_name !!}
                                    </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="article-relate mt-3">
                            <h4>Tuyển dụng liên quan</h4>
                            <div class="row">
                                <?php $lstRelate = $dal_article->getRelatedRecruitment($article) ?>
                                @foreach($lstRelate as $article)
                                    <div class="col-md-4">
                                    <div class="promote-item">
                                        <a href="{!! route('frontend.recruitment.detail',[$article->atc_alias,$article->atc_id]) !!}">
                                            <img class="img-fluid"
                                                 src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg,'c1') !!}"
                                                 alt="{!! $article->atc_title !!}">
                                        </a>
                                        <a class="text-link">{!! $article->atc_title !!}</a>
                                        <span>{!! date('d/m/Y',strtotime($article->created_at)) !!}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="pl-2">TUYỂN DỤNG NỔI BẬT</h4>
                        <div class="article-promote">
                            <?php $lstPromote = $dal_article->getListPromoteRecruitment($article->atc_cate) ?>
                            @foreach($lstPromote as $article)
                            <div class="news-item">
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
                        <a href="{!! route('frontend.recruitment.getListRecruitment') !!}" class="btn btn-block"
                           style="background-color: #3e9364; color: #fff;">@lang('message.dtArticle.seeMore')</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            $('.fb-share').click(function(evt) {
                evt.preventDefault();
                FB.ui({
                    method: 'feed',
                    name: 'Manoj Yadav',
                    link: 'http://www.manojyadav.co.in/',
                    picture: 'https://www.gravatar.com/avatar/119a8e2d668922c32083445b01189d67',
                    description: 'Manoj Yadav a PHP Developer from Mumbai, India'
                });
            });
            $('.tw-share').click(function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                window.open(href, "Twitter", "height=285,width=550,resizable=1");
            });
        });
    </script>
@endsection