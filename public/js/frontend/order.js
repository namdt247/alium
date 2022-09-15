/**
 * Created by QuanVH on 18/05/2019.
 */
$(document).ready(function () {
    $(".cancelOrder").click(function (evt) {
        evt.preventDefault();
        let orderItem = $(evt.target).parents("div.order-item");
        Swal.fire({
            title: 'Bạn có chắc muốn hủy đơn hàng?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3e9364',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            html:'<b>'+ orderItem.find("input.od_name").val() + ' - ID:' + orderItem.find("input.od_code").val() +
              '</b>' + '</br>' +
              '<span class="text-danger">' + orderItem.find("input.od_status").val() + '</span>',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: '/orders/cancel-order/' + orderItem.find("input.od_code").val(),
                    success: function (data) {
                        if (data.status === 200) {
                            Swal.fire({
                                type: 'success',
                                title: 'Hủy đơn hàng thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
    $(".btnReorder").click(function (evt) {
        evt.preventDefault();
        let orderItem = $(evt.target).parents("div.order-item");
        Swal.fire({
            title: 'Bạn có chắc muốn đặt lại đơn hàng?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3e9364',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            html:'<b>'+ orderItem.find("input.od_name").val() + ' - ID:' + orderItem.find("input.od_code").val() +
              '</b>' + '</br>' +
              '<span class="text-danger">' + orderItem.find("input.od_status").val() + '</span>',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: '/orders/reorder/' + orderItem.find("input.od_code").val(),
                    success: function (data) {
                        console.log(data);
                        if (data.status === 200) {
                            Swal.fire({
                                type: 'success',
                                title: 'Đặt lại đơn hàng đơn hàng thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href='/orders/list';
                        }
                    }
                });
            }
        });
    });
    $(".btnCancel").click(function (evt) {
        evt.preventDefault();
        let orderItem = $(evt.target).parents("div.order-item");
        Swal.fire({
            title: 'Bạn có chắc muốn hủy đơn hàng?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3e9364',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            html:'<b>'+ orderItem.find("input.od_name").val() + ' - ID:' + orderItem.find("input.od_code").val() +
              '</b>' + '</br>' +
              '<span class="text-danger">' + orderItem.find("input.od_status").val() + '</span>',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: '/orders/cancel-order/' + orderItem.find("input.od_code").val(),
                    success: function (data) {
                        if (data.status === 200) {
                            Swal.fire({
                                type: 'success',
                                title: 'Hủy đơn hàng thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href = '/orders/list'
                        }
                    }
                });
            }
        })
    });

    $(".btnMoreInfo").click(function (evt) {
        evt.preventDefault();
        let spId = $(evt.target).attr('data-to');
        var supplierEle = $(".supplier-"+spId);
        $("div.supplier-more-info").each(function (index, element) {
            if (!$(element).hasClass("supplier-"+spId))
                $(element).hide();
        });

        if(supplierEle.is(':visible')){
            supplierEle.toggle(300);
        }
        else {
            $.ajax({
                type: "get",
                url: '/get-rate-supplier/' + spId,
                success: function (data) {
                    if (data.status === 200) {
                        let supplier = data.data.supplier;
                        let rate = data.data.rate;

                        if(supplierEle.find("div.order-image").html() === '') {
                            $.each(supplier.image, function (index, value) {
                                let image = $("<img class='img img-fluid' src='/storage/" + value + "' alt='Đơn hàng Alium.vn'/>")
                                let wrapImage = $("<div class='order-image-item'></div>").html(image);
                                supplierEle.find("div.order-image").append(wrapImage);
                            });
                        }
                        $.each(rate, function (index, item) {
                            let numStar = '';
                            for (let i = 1; i <= 5; i++) {
                                if (i <= parseInt(item.rate_star)){
                                    numStar += "<i class=\"fa fa-star star-select\"></i>";
                                } else numStar += "<i class=\"fa fa-star\"></i>";
                            }
                            let headerItem = "<div class=\"head-feedback\">\n" +
                              "        <b>" + item.user.user_showName + "</b>\n" +
                              "        <div class=\"py-3\">\n" +
                              "            <b>" + item.rate_star + "/5</b>\n" +
                              "            <div class=\"float-right text-right\">\n" +
                              "                <span>\n" + numStar +
                              "                </span>\n" +
                              "            </div>\n" +
                              "        </div>\n" +
                              "        <b>"+ item.date + "</b>\n" +
                              "    </div>"
                            let contentFeedback = "<blockquote class=\"blockquote\">\n" +
                              item.rate_content +
                              "    </blockquote>";

                            let newFeedback = $("<div class='feedback-item'></div>").html(headerItem+contentFeedback);
                            supplierEle.find(".feedback-content").append(newFeedback);

                        });

                        supplierEle.show(300);
                    }
                }
            });
        }

    });

    $(".btnSelectSupplier").click(function (evt) {
        evt.preventDefault();
        let spId = $(evt.target).attr('data-to');
        $.ajax({
            type: "post",
            url: '/orders/choose-supplier',
            data: {
                _token: $("input[name='_token']").val(),
                order:  $("input.od_code").val(),
                supplier: spId
            },
            success: function (data) {
                console.log(data);
                if (data.status === 200) {
                    window.location.href = '/orders/payment/'+$("input[name='od_code']").val();
                }
            }
        });


    });

    $(".tick").click(function (evt) {
        let feedbackElement = $(evt.target).parents('#feedback');
        feedbackElement.find("input[name='rateNumber']").val($(evt.target).val());
    });

    $(".btnRate").click(function (evt) {
        evt.preventDefault();
        let feedbackElement = $(evt.target).parents('#feedback');
        numStar = feedbackElement.find("input[name='rateNumber']").val();
        rateContent = feedbackElement.find("textarea[name='txtContent']").val();
        $.ajax({
            type: "post",
            url: '/orders/rate',
            data: {
                _token: $("input[name='_token']").val(),
                order:  $("input.od_code").val(),
                star: numStar,
                content: rateContent,
            },
            success: function (data) {
                if(data.status === 200){
                    Swal.fire({
                        type: 'success',
                        text: 'Cảm ơn bạn đã gửi đánh giá về xưởng cho Alium!\n' +
                          'Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ hotline: 089 664 8544 để được hỗ trợ.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload();
                }
            }
        });
    });

    $(".btnPaymentAction").click(function (evt) {
        evt.preventDefault();
        var odCode = $("input[name='od_code']").val();
        $.ajax({
            type: "post",
            url: '/orders/payment/' + odCode,
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: function (data) {
                if(data.status === 200){
                    Swal.fire({
                        type: 'success',
                        text: 'Alium đã nhận được thông tin thanh toán của Khách hàng. Alium ' +
                            'sẽ xác nhận và liên hệ lại với khách hàng trong thời gian sớm nhất',
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = '/orders/'+odCode
                        }
                    });
                }
            }
        });
    });

    $('.imageOder').slick({
        infinite: false,
        slidesToShow: 3,
    });
})