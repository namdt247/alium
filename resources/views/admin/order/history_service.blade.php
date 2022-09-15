<h2>Lịch sử chăm sóc</h2>
<?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
<?php $lstService = $dal_order->getListChangeStt($odId) ?>
<table id="tblMain" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Ngày thay đổi</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lstService as $detail)
        <?php $odDetail = (object)unserialize($detail->od_detail) ?>
        <tr>
            <th>{!! date('d/m/Y',strtotime($detail->created_at)) !!}</th>
            <?php $status = \App\Models\Order_status::find($odDetail->to) ?>
            <th>{!! $status->stt_valueA !!}</th>
        </tr>
    @endforeach
    </tbody>
</table>