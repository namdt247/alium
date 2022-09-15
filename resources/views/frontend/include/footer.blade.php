<footer>
    <div class="container">
        <div class="py-5">
            <div class="row text-white pt-3">
                <?php
                    $alias = 'footer';
                    $config = \App\Models\Config::where('cfg_alias',$alias)->first();
                    $dataConfig = array_values(\App\Http\DAL\DAL_Config::getConfigByLocale($config->cfg_id));
                ?>
                <div class="col-6 col-sm-6 col-md-3">
                    <img src="/img/1_0022_alium-footer.png" class="img img-fluid pb-4" alt="" style="width: 99px">
                    @foreach($dataConfig as $data)
                        @if($data['id'] == 1)
                            <p class="pb-2 m-0">{!! $data['name'] !!}</p>
                        @elseif($data['id'] == 2)
                            <p class="pb-2 m-0">@lang('message.footer.phone'): <a href="tel:{!! $data['name'] !!}">{!! $data['name'] !!}</a></p>
                        @elseif($data['id'] == 3)
                            <p class="pb-2 m-0">@lang('message.footer.email'): <a href="#">{!! $data['name'] !!}</a></p>
                        @endif
                    @endforeach
                </div>
                <div class="col-6 col-sm-6 col-md-3 pt-sm-0 pt-5 news-cate">
                    <h4>@lang('message.header.newsCate')</h4>
                    <hr>
                    <div class="clearfix"></div>
                    <?php $cateArticle = \App\Models\Cate_article::find(1); ?>
                    <a class="pb-2 d-block" href="{!! route('frontend.article.getListByCate',$cateArticle->cate_alias) !!}"
                        >@lang('message.footer.newsAlium-Er')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.article.getList') !!}">@lang('message.header.newsCate')</a>
                </div>
                <div class="col-6 col-sm-6 col-md-3 pt-md-0 pt-5">
                    <h4>@lang('message.footer.aboutUs')</h4>
                    <hr>
                    <div class="clearfix"></div>
                    <a class="pb-2 d-block" href="{!! route('frontend.policy.getPage','ve-alium') !!}"
                        >@lang('message.footer.introduce')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.recruitment.getListRecruitment') !!}"
                        >@lang('message.footer.jobs')</a>  
                    <a class="pb-2 d-block" href="{!! route('frontend.policy.getPage','chinh-sach-bao-mat') !!}"
                        >@lang('message.footer.security')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.policy.getPage','dieu-khoan') !!}"
                        >@lang('message.footer.rules')</a>
                </div>
                <div class="col-6 col-sm-6 col-md-3 pt-md-0 pt-5">
                    <h4>@lang('message.footer.customerCare')</h4>
                    <hr>
                    <div class="clearfix"></div>
                    <a class="pb-2 d-block" href="{!! route('frontend.faq.getGuide','dat-san-xuat') !!}"
                        >@lang('message.footer.guideProduce')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.faq.getGuide','dang-ky-xuong') !!}"
                        >@lang('message.footer.guideRegisterSup')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.faq.getGuide','thanh-toan') !!}"
                        >@lang('message.footer.payment')</a>
                    <a class="pb-2 d-block" href="{!! route('frontend.faq.getAdd') !!}">@lang('message.footer.customerCare')</a>
                </div>
            </div>
            <div class="mt-4 pt-2 text-center">
                @foreach($dataConfig as $data)
                    @if($data['id'] == 4)
                        <a href="{!! $data['name'] !!}" target="_blank">
                            <img class="p-2 img img-fluid" src="/img/facebook-letter-logo.png" alt="">
                        </a>
                    @elseif($data['id'] == 5)
                        <a href="{!! $data['name'] !!}" target="_blank">
                            <img class="p-2 img img-fluid" src="/img/youtube-logo.png" alt="">
                        </a>
                    @elseif($data['id'] == 6)
                        <a href="{!! $data['name'] !!}" target="_blank">
                            <img class="p-2 img img-fluid" src="/img/google-plus-logo.png" alt="">
                        </a>
                    @elseif($data['id'] == 7)
                        <a href="{!! $data['name'] !!}" target="_blank">
                            <img class="p-2 img img-fluid" src="/img/linkedin-logo.png" alt="">
                        </a>
                    @elseif($data['id'] == 8)
                        <a href="{!! $data['name'] !!}" target="_blank">
                            <img class="p-2 img img-fluid" src="/img/instagram-logo.png" alt="">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</footer>
