<section id="review" class="feature text-center">
    <div class="bg-face">
        <div class="container py-5 page-mobile-4">
            <h2 class="py-4 px-0 px-md-20 review-title h2-size-mobile">@lang('message.home.feature.experience')</h2>
            <div class="pb-5 mb-2">
                <div class="row" id="reviewSlider">
                    <?php $dal_rate = new \App\Http\DAL\DAL_Rate(); ?>
                    <?php $lstRate = $dal_rate->getListRateFeature();?>
                    @foreach($lstRate as $rate)
                    <div class="slideItem p-4 text-center">
                        <div class="bg-white p-4">
                            @if($rate->user->user_avatar)
                                <img class="rounded-circle d-inline-block my-3" width="85"
                                     src="{!! \App\Helper\Common::GetThumb($rate->user->user_avatar) !!}"
                                     alt="{!! $rate->user->user_showName !!}">
                            @else
                                <img class="rounded-circle d-inline-block my-3" width="85" src="/img/user_default.png"
                                     alt="{!! $rate->user->user_showName !!}">
                            @endif
                            <h4 class="review-author">{!! $rate->user->user_showName !!}</h4>
                            @if($rate->user->city)
                                <p class="location">{!! $rate->user->city->city_name !!}
                            @endif
                            <p>
                            <h3 class="my-4">{!! $rate->rate_title ? $rate->rate_title : 'Tuyệt vời'!!}</h3>
                            <p>{!! $rate->rate_content !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>