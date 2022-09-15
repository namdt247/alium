<div>
    <h3 class="pb-5 title-step title-step-mobile">@lang('message.order.step1')</h3>
    <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
    <?php $lstFeature = $dal_product->getListProductFeature(); ?>
    <?php $lstFeatureId = [] ?>
    <div class="row">
        @if($lstFeature && count($lstFeature)>0)
            <?php array_push($lstFeatureId,$lstFeature[0]->prd_id) ?>
        <div class="col-md-6 product-item">
            <a href="#" data-id="{!! $lstFeature[0]->prd_id !!}">
                <img class="img-fluid"
                     src="{!! \App\Helper\Common::GetThumb($lstFeature[0]->prd_featureImg,'c1') !!}"
                     alt="{!! $lstFeature[0]->prd_name !!}">
            </a>
        </div>
        @endif
        @for($i = 1; $i<count($lstFeature); $i++)
                <?php array_push($lstFeatureId,$lstFeature[$i]->prd_id) ?>
            <?php $image = isset($lstFeature[$i]->image[0]) ? $lstFeature[$i]->image[0]->img_src : '' ?>
        <div class="col-md-3 product-item">
            <a href="#" data-id="{!! $lstFeature[$i]->prd_id !!}">
                <img class="img-fluid" src="{!! \App\Helper\Common::GetThumb($image) !!}"
                     alt="{!! $lstFeature[$i]->prd_name !!}">
            </a>
        </div>
        @endfor
    </div>
    <?php $lstCate = $dal_product->getListTreeProduct(); ?>
    @foreach($lstCate as $cate)
    <h3 class="text-dark pt-5 pb-2 cate-value">{!! $cate->cate_value !!}</h3>
    <div class="row">
        @foreach($cate->product as $product)
            <?php $image = isset($product->image[0]) ? $product->image[0]->img_src : '' ?>
        <div class="col-md-3 product-item text-center">
            <a href="#" data-id="{!! $product->prd_id !!}">
                <img class="img-fluid" src="{!! \App\Helper\Common::GetThumb($image) !!}"
                     alt="{!! $product->prd_name !!}">
                <p class="prd-name-font">{!! $product->prd_name !!}</p>
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
