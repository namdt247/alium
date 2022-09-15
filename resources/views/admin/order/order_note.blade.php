<div class="box box-danger">
    <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
    <?php $lstNote = $dal_order->getNoteByOrder($odId);?>
    <div class="box-header">
        <h3 class="box-title">Ghi chú</h3>
    </div>
    <div class="box-body">
        @foreach($lstNote as $note)
            <div class="post clearfix">
                <div class="user-block">
                    <?php
                    $userAvatar = $note->assignee ?
                        \App\Helper\Common::GetThumb($note->assignee->user_avatar) : asset('img/user_default.png');
                    ?>
                    <img class="img-circle img-bordered-sm" src="{!! $userAvatar !!}"
                         alt="User Image">
                    <span class="username">
                          <a href="#">{!! $note->assignee->user_showName !!}</a>
                        </span>
                    <span class="description">{!! date('H:i, d/m/Y',strtotime($note->created_at)) !!}</span>
                </div>
                <!-- /.user-block -->
                <p>
                    {!! nl2br($note->od_detail) !!}
                </p>
            </div>
        @endforeach
        <div class="form-horizontal">
            <div class="form-group margin-bottom-none">
                <div class="col-sm-9">
                            <textarea name="note" id="" cols="30" rows="3" class="form-control"
                                      placeholder="Ghi chú mới..."></textarea>
                </div>
                <div class="col-sm-3">
                    <a href="#" class="btn btn-warning pull-right btn-block btn-sm update-note">Thêm ghi chú</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>