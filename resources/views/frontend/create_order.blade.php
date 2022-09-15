<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-07-07
 * Time: 10:18
 */
?>

@extends('frontend.layout_master')

@section('main-content')
    @if(Auth::check())
    <section style="border-top: solid 1px #000; border-bottom: solid 1px #000;">
        <div class="container text-center">
            <div class="row">
                <ul class="nav nav-tabs" id="orderStep" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-step1"
                           href="#orderStep1"
                           role="tab" aria-controls="content-javascript" aria-selected="false">
                            <span>1</span> @lang('message.order.step1')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-step2"
                           href="#orderStep2"
                           role="tab" aria-controls="content-css" aria-selected="false">
                            <span>2</span> @lang('message.order.step2')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-step3"
                           href="#orderStep3"
                           role="tab" aria-controls="content-bootstrap" aria-selected="true">
                            <span>3</span> @lang('message.order.step3')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="container">
        <form method="post" class="order tab-content my-5" id="order-form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" value="" name="imgId" id="imgId">
            <input type="hidden" name="prdId" value="" id="prdId">
            <div class="tab-pane fade show active" id="orderStep1"
                 role="tabpanel" aria-labelledby="tab-step1">
                @include('frontend.order.tab_step1')
            </div>
            <div class="tab-pane fade" id="orderStep2"
                 role="tabpanel" aria-labelledby="tab-step2">
                @include('frontend.order.tab_step2')
            </div>
            <div class="tab-pane fade" id="orderStep3"
                 role="tabpanel" aria-labelledby="tab-step3">
                @include('frontend.order.tab_step3')
            </div>


        </form>
    </section>
    @else
        <input type="hidden" value="0" id="userLogin">
    @endif
@endsection

@section('main-script')
    <script src="component/dropzone/dropzone.js"></script>
    <script>
        var product = 0, currentProduct = 0;
        var totalQuantity = 0; wantedPrice = 0;
        var orderStep1 = $("#orderStep1");
        var orderStep2 = $("#orderStep2");
        var orderStep3 = $("#orderStep3");
        var maxFiles = 4;

        Dropzone.autoDiscover = false;
        var _dropzone = new Dropzone("#dropzone",{
            url: "/product/uploader-order" ,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictRemoveFile: '@lang('message.order.step2.deleteImg')',
            maxFiles:maxFiles,
            dictDefaultMessage: '@lang('message.order.step2.imgNotice')',
            dictMaxFilesExceeded: '@lang('message.order.step2.imgNotice2')',
            processing: function(file){
                orderStep2.find("button.btnStep2").attr('disabled',true);
            },
            removedfile: function(file){
                maxFiles++;
                var server_file = $(file.previewTemplate).children('.server_file').text();
                file.previewElement.remove();
                // call server to remove file
                $.ajax({
                    url: "/product/delete-image/"+server_file,
                });

                // update list id image of product
                let txtImageId = $("#imgId").val();
                let arrImageId = txtImageId.split(",");
                let indexRemove = arrImageId.indexOf(server_file);
                if(indexRemove >= 0) arrImageId.splice(indexRemove, 1);
                $("#imgId").val(arrImageId.toString());
            },
            success: function(file, response){
                if(response.uploaded === 1){
                    maxFiles--;
                    $(file.previewTemplate).append('<span class="server_file d-none">'+response.img_id+'</span>');
                    txtImageId = $("#imgId").val();
                    if(txtImageId && txtImageId != ''){
                        txtImageId = txtImageId + ',' + response.img_id;
                    }else{
                        txtImageId = response.img_id;
                    }
                    $("#imgId").val(txtImageId);
                }
            },
            error: function(file, message, xhr) {
                $(file.previewElement).remove();
            },
            queuecomplete: function(){
                orderStep2.find("button.btnStep2").attr('disabled',false);
            },
        });
     
        $(document).ready(function () {
            $(".district").select2();
            $(".city").select2();
            $(".country").select2();

            $(".product-item a").click(function (evt) {
                topFunction();
                evt.preventDefault();
                $(".product-item a").removeClass('active');
                $(this).addClass('active');
                product = parseInt($(this).attr('data-id'));
                $("#prdId").val(product);
                $('#orderStep a[href="#orderStep2"]').tab('show');
                orderStep2.find("button.btnStep2").attr('disabled',false);
            });

            // $("#tab-step1").click(function(evt) {
            //     $('#orderStep a[href="#orderStep1"]').tab('show');
            // });  

            // $("#tab-step2").click(function(evt) {
            //     $('#orderStep a[href="#orderStep2"]').tab('show');
            // });

            // $("#tab-step3").click(function(evt) {
            //     $('#orderStep a[href="#orderStep3"]').tab('show');
            // });

            $('.price').inputmask({
                alias: 'numeric',
                groupSeparator: '.',
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                prefix: '',
                rightAlign:true,
                autoUnmask: true,
                removeMaskOnSubmit:true
            });

            $("#orderStep2 button.btnStep2").click(function (evt) {
                evt.preventDefault();
                //validate
                if (validateStep2()){
                    $('#orderStep a[href="#orderStep3"]').tab('show');
                    orderStep3.find("button.btnStep3").attr("disabled",false);
                    topFunction();
                }
            });

            $("#orderStep3 button.btnStep3").click(function (evt) {
                evt.preventDefault();
                //validate
                if (validateStep3()){
                    $("#order-form").submit();
                }
            });

            function validateStep2() {
                $("p.error").addClass('d-none');
                let check = true;
                let quantityElement = orderStep2.find("input[name='totalQuantity']");
                totalQuantity = parseInt(quantityElement.val());

                let wantedPriceElement = $("#wanted-price");
                let priceElement = orderStep2.find("input[name='wantedPrice']");
                wantedPrice = parseInt(priceElement.val());

                let requireElementDiv = $("#require-div");
                let requireElement = orderStep2.find("input[name='require[]']");
                requireCheck = requireElement.is(":checked");

                if (!totalQuantity || totalQuantity < 50){
                    check = false;
                    quantityElement.siblings("p.error-quantity").removeClass('d-none')
                        .html("@lang('message.order.step2.quantityNotice')");
                    quantityElement.focus();
                }

                if (!wantedPrice){
                    check = false;
                    wantedPriceElement.children("p.error-price").removeClass('d-none')
                        .html("Vui lòng điền giá mong muốn");
                    priceElement.focus();
                }

                if (!requireCheck){
                    check = false;
                    requireElementDiv.children("p.error-require").removeClass('d-none')
                        .html("Vui lòng tick chọn yêu cầu của bạn");
                    emailElement.focus();
                }

                let txtImageId = $("#imgId").val();
                let arrImageId = txtImageId.split(",");
                if (arrImageId.length < 2 || arrImageId.length > 4) {
                    check = false;
                    $("#dropzone").siblings("p.error-image").removeClass('d-none')
                        .html("@lang('message.order.step2.selectImg')");
                    $("#dropzone").attr("tabindex",-1).focus();
                }
                return check;
            }

            function validateStep3() {
                $("p.error").addClass('d-none');
                let check = true;
                let emailElement = orderStep3.find("input[name='email']");
                emailCheck = emailElement.val();

                let nameElement = orderStep3.find("input[name='name']");
                nameCheck = nameElement.val();

                let phoneElementDiv = $("#phone-element");
                let phoneElement = orderStep3.find("input[name='phone']");
                phoneCheck = parseInt(phoneElement.val());

                let addressElement = orderStep3.find("input[name='address']");
                addressCheck = addressElement.val();

                let cityElement = orderStep3.find("select[name='city']");
                cityCheck = parseInt(cityElement.val());

                let districtElement = orderStep3.find("select[name='district']");
                districtCheck = parseInt(districtElement.val());

                let deliverDateElement = orderStep3.find("input[name='deliverDate']");
                deliverDateCheck = parseInt(deliverDateElement.val());
               
                if (!emailCheck){
                    check = false;
                    emailElement.siblings("p.error-email").removeClass('d-none')
                        .html("Vui lòng nhập Email");
                    emailElement.focus();
                }

                if (!nameCheck){
                    check = false;
                    nameElement.siblings("p.error-name").removeClass('d-none')
                        .html("Vui lòng nhập Họ tên");
                    nameElement.focus();
                }

                if (!phoneCheck){
                    check = false;
                    phoneElementDiv.children("p.error-phone").removeClass('d-none')
                        .html("Vui lòng nhập Số điện thoại");
                    phoneElement.focus();
                }

                if (!addressCheck){
                    check = false;
                    addressElement.siblings("p.error-address").removeClass('d-none')
                        .html("Vui lòng nhập Địa chỉ nhận hàng");
                    addressElement.focus();
                }

                if (cityCheck == 0){
                    check = false;
                    cityElement.siblings("p.error-city").removeClass('d-none')
                        .html("Vui lòng chọn Tỉnh/Thành phố");
                    cityElement.focus();
                }

                if (districtCheck == 0){
                    check = false;
                    districtElement.siblings("p.error-district").removeClass('d-none')
                        .html("Vui lòng chọn Quận/huyện");
                        districtElement.focus();
                }

                if (!deliverDateCheck){
                    check = false;
                    deliverDateElement.siblings("p.error-deliverDate").removeClass('d-none')
                        .html("Vui lòng chọn Thời gian nhận hàng");
                }
                return check;
            }

            var country = 0, city = 0, district = 0;
            var sltCountry = orderStep3.find("select.country");
            var sltCity = orderStep3.find("select.city");
            var sltDistrict = orderStep3.find("select.district");

            function resetSelectCity(data = []) {
                data.unshift({id: 0, text: " --- @lang('message.order.step3.selectCity') --- "});
                sltCity.html('');
                sltCity.select2('destroy');
                sltCity.select2({data: data});
                if(city > 0) sltCity.val(city).trigger('change');
            }

            function resetSelectDistrict(data = []) {
                data.unshift({id: 0, text: " --- @lang('message.order.step3.selectDistrict') --- "});
                sltDistrict.html('');
                sltDistrict.select2('destroy');
                sltDistrict.select2({data: data});
                if(district > 0) sltDistrict.val(district).trigger('change');
            }

            sltCountry.change(function (evt) {
                let ctyId = parseInt(sltCountry.val()) || 0;
                if (ctyId === 0) {
                    country = 0; city = 0; district = 0;
                    resetSelectCity();
                    resetSelectDistrict();
                    return;
                }
                // dont check new ctyId equal current country because of when select user,
                // mayby user_city equal to current user_city
                country = ctyId;
                $.ajax({
                    url: "/get-city/" + ctyId,
                    method: 'get'
                }).done(function (data) {
                    resetSelectCity(data);
                    resetSelectDistrict();
                });

            });

            sltCity.change(function (evt) {
                let cityId = parseInt(sltCity.val()) || 0;
                if (cityId === 0) {
                    city = 0; district = 0;
                    resetSelectDistrict();
                }
                else {
                    city = cityId;
                    $.ajax({
                        url: "/get-district/" + cityId,
                        method: 'get'
                    }).done(function (data) {
                        resetSelectDistrict(data);
                    });
                }
            });

            $('[data-toggle="popover"]').popover();
            $('.popover-dismiss').popover({
                trigger: 'focus'
            });
            $('input.date').datepicker({
                autoclose: true,
                clearBtn: true,
                startDate: '+1d',
                todayHighlight: true,
                format: 'dd/mm/yyyy'
            });
            
            $('a.trigger1').hover(function(evt) {
                $('div#popup1').show();
            }, function() {
                $('div#popup1').hide();
            });

            $('a.trigger2').hover(function(evt) {
                $('div#popup2').show();
            }, function() {
                $('div#popup2').hide();
            });
            
            $('a.trigger3').hover(function(evt) {
                $('div#popup3').show();
            }, function() {
                $('div#popup3').hide();
            });

            $('a.trigger4').hover(function(evt) {
                $('div#popup4').show();
            }, function() {
                $('div#popup4').hide();
            });
        });
    </script>
@endsection