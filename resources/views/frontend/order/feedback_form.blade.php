<div class="order-feedback order-info" id="feedback">
    <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
    @if(!$dal_order->checkUserRateOrder($order->od_id))
        <div class="info-header clearfix">
            <h4 class="float-left">@lang('message.feedback.opinion')</h4>
            <span class="float-right text-success">@lang('message.feedback.service')</span>
        </div>
        <div class="order-info-inner">
            <div class="mb-3">
                <span>&nbsp; {!! Auth::user()->user_showName !!}</span>
                <span class="px-3"> | </span>
                <span>{!! date('d/m/Y') !!}</span>
                <div class="float-right text-right">
                    <fieldset class="rate-action">
                        <input type="hidden" name="rateNumber" value="5">
                        <input class="tick" type="radio" id="star5" name="rating" value=5 checked/>
                        <label class = "full" for="star5" title="@lang('message.feedback.rate5')"></label>
                        <input class="tick" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="@lang('message.feedback.rate4')"></label>
                        <input class="tick" type="radio" id="star3" name="rating" value="3" />
                        <label class = "full" for="star3" title="@lang('message.feedback.rate3')"></label>
                        <input class="tick" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="@lang('message.feedback.rate2')"></label>
                        <input class="tick" type="radio" id="star1" name="rating" value="1" />
                        <label class = "full" for="star1" title="@lang('message.feedback.rate1')"></label>
                    </fieldset>
                </div>
            </div>
            <textarea name="txtContent" id="" cols="30" rows="3" class="form-control"
                      placeholder="@lang('message.feedback.opinionPlace')"></textarea>
            <span class="char-count">0/225</span>
        </div>
        <div class="rating">
            <button type="button" class="btn btnRate">@lang('message.feedback.send')</button>
        </div>
    @endif
    <div class="reorder">
        <a href="{!! route('frontend.order.getReorder',$order->od_code) !!}"
           class="btn btnReorder">@lang('message.feedback.reproduce')</a>
    </div>
</div>