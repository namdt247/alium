//variables
var otherRequire = false, bill = false, template = false;
var customerId = 0, country = 0, city = 0, district = 0;
var orderStatus = 2, productOrder = 0;
var numXL = 0, numL = 0, numM = 0, numS = 0, numXS = 0, numTotal = 0;
var supplierSelected = 0, totalPrice = 0, templatePrice = 0, productPrice = 0, priceUnit = 0;
var email = '', name = '', phone = '', postalCode = '', address = '';

var frmOrder = $("#frmOrder");
var customerInfo = $("#customer-info");
var sltCountry = customerInfo.find("select.customer-country");
var sltCity = customerInfo.find("select.customer-city");
var sltDistrict = customerInfo.find("select.customer-district");
var txtName = customerInfo.find('input.customer-name');
var txtEmail = customerInfo.find('input.customer-email');
var txtPhone = customerInfo.find('input.customer-phone');
var txtAddress = customerInfo.find("input.customer-address");
var txtPostalCode = customerInfo.find('input.customer-code');
var orderDetail = $("#order-detail");
var orderTemplate = orderDetail.find('input.order-template');
var statusSelect = $("#order-status");
var supplier1 = $("#supplier1");
var supplier2 = $("#supplier2");
var supplier3 = $("#supplier3");
var orderId = parseInt($("#lbId").val()) || 0;

//dom element
var supplierSelect = $(".supplier");
var paymentElement = $("#order-payment");

var orderPrice = $("#order-price");
var priceTemplate = frmOrder.find("input.priceTemplate");
var priceUnitElement = orderPrice.find("span.price-unit");

function eventSwitch() {
    orderTemplate.change(function (evt) {
        if (evt.target.checked) {
            template = true;
            priceTemplate.prop("readonly", false);
        } else {
            template = false;
            priceTemplate.prop('readonly', true)
        }
        paymentSupplier();
        countTotalPrice();
    });
    orderDetail.find("input.order-other").change( function(evt) {
        otherRequire = evt.target.checked;
    });

    orderDetail.find("input.order-bill").change( function(evt) {
        bill = evt.target.checked;
    });
}

function paymentSupplier () {
    $("div.sp-option").each(function(index,item){
        calculatePayment($(item));
    });
}

function calculatePayment (ele) {
    let spPriceUnit = parseInt(ele.find("input.price-unit").val());
    let spTotalPrice = numTotal * spPriceUnit;
    if (bill) spTotalPrice = spTotalPrice * 1.1;
    let spPriceTemplate = parseInt(ele.find("input.priceTemplate").val());
    let payment = [], payment1 = 0, payment2 = 0, payment3 = 0;
    if (spTotalPrice < 100 * 1000 * 1000) {
        payment2 = spTotalPrice;
    }
    else if (spTotalPrice < 500 * 1000 * 1000) {
        payment2 = spTotalPrice * 0.6;
        payment3 = spTotalPrice * 0.4;
    }
    else {
        payment2 = spTotalPrice * 0.4;
        payment3 = spTotalPrice * 0.6;
    }
    if (template) {
        payment1 = spPriceTemplate;
        payment.push(payment1,payment2,payment3);
    }
    else {
        payment.push(payment2,payment3);
    }
    ele.find("input.pricePayment").val(function(index){
        return payment[index];
    });
}

function initCheckbox(){
    supplierSelect.iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    });

    supplierSelect.on('ifChecked', function(evt){
        supplierSelected = parseInt(evt.target.getAttribute('data-id')) || 0;
        supplierElement = $("#supplier"+supplierSelected);
        priceUnit = parseInt(supplierElement.find("input.price-unit").val()) || 0;
        if(priceUnit) {
            priceUnitElement.html(priceUnit);
        }
        else {
            priceUnitElement.html(0);
        }
        countTotalPrice();
    });
}

function initSelect2() {
    //init select2
    sltCountry.select2();
    sltCity.select2();
    sltDistrict.select2();
    $(".user-select").select2({
        ajax: {
            url: "/admin/user/search-user",
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true,
        },
        minimumInputLength: 2,
        allowClear: true
    });
    $(".supplier-select").select2({
        ajax: {
            url: "/admin/user/search-supplier",
            processResults: function (data) {
                let selectedValue = [
                    parseInt(supplier1.find(".supplier-select").val()) || 0,
                    parseInt(supplier2.find(".supplier-select").val()) || 0,
                    parseInt(supplier3.find(".supplier-select").val()) || 0
                ];
                data.filter(function (item) {
                    for (var i = 0; i < 3; i++){
                        if (selectedValue[i] === parseInt(item.id)) item.disabled = true
                    }
                });
                return {
                    results: data
                };
            },
            cache: true,
        },
        minimumInputLength: 2,
        allowClear: true
    });
}

function initDatePicker() {
    //Date picker
    customerInfo.find("input.customer-date").datepicker({
        autoclose: true,
        clearBtn: true,
        startDate: '+1d',
        todayHighlight: true
    })
}

function eventSelectUser() {
    let customerElement = $("#customer-id");
    customerElement.change(function (evt) {
        customerId = parseInt(customerElement.val()) || 0;
        $.ajax({
            url: "/admin/user/detail-user/" + customerId,
            method: 'get'
        }).done(function (data) {
            email = data.user_email;
            name = data.user_showName;
            phone = data.user_phone;
            address = data.user_address;
            postalCode = data.user_postalCode;
            country = data.user_country;
            city = data.user_city;
            district = data.user_district;

            sltCountry.val(country).trigger('change');
            txtEmail.val(email);
            txtPostalCode.val(postalCode);
            txtAddress.val(address);
            txtName.val(name);
            txtPhone.val(phone);
        });
    });
}

function eventSelectAddress() {
    function resetSelectCity(data = []) {
        data.unshift({id: 0, text: " --- Chọn tỉnh/thành phố --- "});
        sltCity.html('');
        sltCity.select2('destroy');
        sltCity.select2({data: data});
        if(city > 0) sltCity.val(city).trigger('change');
    }

    function resetSelectDistrict(data = []) {
        data.unshift({id: 0, text: " --- Chọn quận/huyện --- "});
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
}

function eventPrice() {
    priceTemplate.change(function () {
        templatePrice = parseInt(priceTemplate.val()) || 0;
        if (template) countTotalPrice();
    });

    $("input.price-unit").change(function (evt) {
        let supplierParrent = $(evt.target).closest("div.sp-option")
            .find("input.supplier");
        calculatePayment($(evt.target).closest("div.sp-option"));
        parentSupplierId = parseInt(supplierParrent[0].getAttribute('data-id')) || 0;
        if(parentSupplierId === supplierSelected) {
            priceUnit = parseInt($(evt.target).val()) || 0;
            priceUnitElement.html(priceUnit);
            countTotalPrice();
        }
    });

    $(".pricePayment1,.pricePayment2").change(function (evt) {
        let ele = $(evt.target).closest("div.sp-option");
        let spPriceUnit = parseInt(ele.find("input.price-unit").val());
        let spTotalPrice = numTotal * spPriceUnit;
        let spPriceTemplate = parseInt(ele.find("input.priceTemplate").val());

        let payment = [];
        let payment1 = parseInt(ele.find("input.pricePayment1").val());
        let payment2 = parseInt(ele.find("input.pricePayment2").val());
        let payment3 = 0;

        if (template) {
            if (spTotalPrice < 100 * 1000 * 1000) {
                payment2 = spTotalPrice + spPriceTemplate - payment1;
            }
            else {
                payment3 = spTotalPrice + spPriceTemplate - payment1 - payment2;
            }
        }
        else {
            payment2 = spTotalPrice - payment1
        }
        payment.push(payment1,payment2,payment3);
        ele.find("input.pricePayment").val(function(index,currentvalue){
            return payment[index];
        });
    });

    countNumTotal();

}

function countNumTotal () {
    /*
    $(".size").change(function () {
        let sizeElement = orderDetail.find("div.number-size");
        numXL = parseInt(sizeElement.find("input.sizeXL").val()) || 0;
        numL = parseInt(sizeElement.find("input.sizeL").val()) || 0;
        numM = parseInt(sizeElement.find("input.sizeM").val()) || 0;
        numS = parseInt(sizeElement.find("input.sizeS").val()) || 0;
        numXS = parseInt(sizeElement.find("input.sizeXS").val()) || 0;

        numTotal = numXL + numL + numM + numS + numXS;
        orderPrice.find("span.numTotal").html(numTotal);
        countTotalPrice();
    });
    */
    $(".sizeTotal").change(function (evt) {
        numTotal = parseInt(evt.target.value);
        orderPrice.find("span.numTotal").html(numTotal);
        paymentSupplier();
        countTotalPrice();
    });
}

function countTotalPrice() {
    //use signle quantity textbox, dont need to count by size
    productPrice = numTotal * priceUnit;
    if(bill) productPrice = productPrice * 1.1;
    totalPrice = template? templatePrice + productPrice : productPrice;
    txtTotalPrice = new Intl.NumberFormat('vi-VN').format(totalPrice);
    orderPrice.find("span.priceTotal").html(txtTotalPrice);
}

function eventOrderStatus() {
    statusSelect.change(function (evt) {
        orderStatus = parseInt($(evt.target).val()) || 0;
        if(orderStatus > 1) paymentElement.show(500);
        else paymentElement.hide(500);
    });
}

function extraValidate() {
    let customerSelect = $("#customer-id");
    let productSelect = orderDetail.find("select.order-product");
    let sizeElement = orderDetail.find("div.number-size");

    //clear error text
    customerSelect.siblings("p.error-detail").html('').hide();
    productSelect.siblings("p.error-detail").html('').hide();
    sizeElement.siblings("p.error-detail").html('').hide();
    sltCountry.siblings("p.error-detail").html('').hide();
    sltCity.siblings("p.error-detail").html('').hide();
    sltDistrict.siblings("p.error-detail").html('').hide();
    statusSelect.siblings("p.error-detail").html('').hide();

    let error = false;
    if(!customerId || customerId <= 0){
        error = true;
        customerSelect.siblings("p.error-detail").html('Chọn người đặt hàng').show();
        customerSelect.focus();
    }
    if(!country || country <= 0){
        error = true;
        sltCountry.siblings("p.error-detail").html('Chọn quốc gia').show();
        sltCountry.focus();
    }
    // if(!city || city <= 0){
    //     error = true;
    //     sltCity.siblings("p.error-detail").html('Chọn tỉnh/thành phố').show();
    //     sltCity.focus();
    // }
    // district = parseInt(sltDistrict.val()) || 0;
    // if(district <= 0){
    //     error = true;
    //     sltDistrict.siblings("p.error-detail").html('Chọn quận/huyện').show();
    //     sltDistrict.focus();
    // }
    productOrder = parseInt(productSelect.val()) || 0;
    if (!productOrder || productOrder <= 0) {
        error = true;
        productSelect.siblings("p.error-detail").html('Chọn dòng sản phẩm').show();
        productSelect.focus();
    }
    if(numTotal <= 0){
        error = true;
        sizeElement.siblings("p.error-detail").html('Chọn số lượng đặt hàng').show();
        sizeElement.attr("tabindex",-1).focus();
    }

    // if(orderStatus !== 1 && supplierSelected === 0) {
    //     error = true;
    //     statusSelect.siblings("p.error-detail").html('Chưa lựa chọn xưởng').show();
    //     statusSelect.focus();
    // }
    return !error;
}

function initValueByTag () {
    otherRequire = orderDetail.find("input.order-other").prop('checked');
    bill = orderDetail.find("input.order-bill").prop('checked');
    template = orderTemplate.prop('checked');

    orderStatus = parseInt(statusSelect.val()) || 0;

    let sizeElement = orderDetail.find("div.number-size");
    numXL = parseInt(sizeElement.find("input.sizeXL").val()) || 0;
    numL = parseInt(sizeElement.find("input.sizeL").val()) || 0;
    numM = parseInt(sizeElement.find("input.sizeM").val()) || 0;
    numS = parseInt(sizeElement.find("input.sizeS").val()) || 0;
    numXS = parseInt(sizeElement.find("input.sizeXS").val()) || 0;

    let customerElement = $("#customer-id");
    customerId = parseInt(customerElement.val()) || 0;

    let productSelect = orderDetail.find("select.order-product");
    productOrder = parseInt(productSelect.val()) || 0;

    numTotal = numXL + numL + numM + numS + numXS;

    supplierSelected = parseInt($('input[name=supplier]:checked').val()) || 0;
    supplierElement = $("#supplier"+supplierSelected);
    priceUnit = parseInt(supplierElement.find("input.price-unit").val()) || 0;

    templatePrice = parseInt(priceTemplate.val()) || 0;
}

function initOrder(){

    initFilePreview();
    initDatePicker();
    initSelect2();
    initCheckbox();
    eventSelectAddress();
    eventSelectUser();
    eventPrice();
    eventSwitch();
    eventOrderStatus();

    initValueByTag();
    //check for edit case
    if(orderId > 0) {
        country = currentCountry; city = currentCity; district = currentDistrict;
        sltCountry.val(country).trigger('change');
    }

    numTotal = parseInt($(".sizeTotal").val());

    frmOrder.submit(function (evt) {
        if (!frmOrder.validate() || !extraValidate()){
            evt.preventDefault();
            return false;
        }
    });

    $("a.btn-delete").click(function (evt) {
        evt.preventDefault();
        const confirm = window.confirm("Are you sure to delete image");
        if(confirm === true) {
            let linkLocation = $(this).attr("href");
            var parentDiv = $(evt.target).closest('div.img-container');
            $.ajax({
                url: linkLocation,
                success: function (apiCode) {
                    if (parseInt(apiCode) === 200) {
                        parentDiv.remove();
                    }
                }
            });
        }
    });
}

function updateNote(){
    $('a.update-note').click(function (evt) {
        evt.preventDefault();
        $.ajax({
            url: "/admin/product/order/update-note",
            method: 'post',
            data: {
                _token: $("input[name='_token']").val(),
                order: $("input[name='lbId']").val(),
                note: $("textarea[name='note']").val(),
            },
            success: function (data) {
                if (data.status === 200){
                    alert('cập nhật ghi chú thành công')
                    location.reload();
                }
            }
        });
        return false;
    });
}
$(document).ready(function () {
    initOrder();
    updateNote();
});
