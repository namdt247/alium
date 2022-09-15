<h2>Danh sách gợi ý</h2>
<table id="tblMain" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Đơn hàng</th>
        <th>Xưởng may</th>
        <th>Giá báo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lstOrder as $odSuggest)
        <?php $odDetail = unserialize($odSuggest->od_content) ?>
        @foreach($odSuggest->suggest_uMake as $key=>$spSuggest)
            <tr>
                @if($key==0)
                    <td rowspan="{!! count($odSuggest->suggest_uMake) !!}">
                        {!! $odSuggest->od_code !!}
                        <br>
                        Giá mong muốn: {!! number_format(is_array($odDetail)
                            && array_key_exists('price_factory', $odDetail)? $odDetail['price_factory']:0,0,',','.' )!!}
                        <br>
                        Chất lượng: {!! $odSuggest->quality !!}
                        <br>
                        Số lượng: {!! $odSuggest->od_quantity !!}
                    </td>
                @endif
                <td><a href="{!! route('admin.supplier.getEdit',$spSuggest->supplier->sp_id) !!}"
                       target="_blank">{!! $spSuggest->supplier->sp_code !!}</a>
                </td>
                <td>{!! number_format($spSuggest->od_priceUnit,0,',','.') !!}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>

