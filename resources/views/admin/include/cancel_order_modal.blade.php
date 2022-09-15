<!-- Cancel Modal -->
<div class="modal fade" id="modalCancel" tabindex="-1" role="dialog" aria-labelledby="modalCancelCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="cancelOrderForm" method="post">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center">
                    <h3 class="modal-title text-danger">Huỷ đơn hàng</h3>
                </div>
                <div class="modal-body">
                    <input type="text" name="odId" id="odId" hidden/>
                    <div class="form-group">
                        <label>Lý do huỷ</label>
                        <select style="width: 100%" name="reasonCancel" id="reasonCancel"
                                class="form-control select2" required>
                            <option value="">--- Chọn lý do huỷ ---</option>
                            @foreach(\App\Helper\_ObjectType::REASON_CANCEL as $reason)
                                <option value="{!! $reason !!}">{!! $reason !!}</option>
                            @endforeach
                        </select>
                        <label class="txtError text-danger" hidden></label>
                    </div>
                    <div class="form-group">
                        <label>Nhập ghi chú</label>
                        <textarea name="note" rows="4" class="form-control"
                                  placeholder="Ghi chú huỷ đơn hàng..."></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Huỷ đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>