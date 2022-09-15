function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("goTop").style.display = "block";
    } else {
        document.getElementById("goTop").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function showDevelopPopup(){
    Swal.fire({
        type: 'info',
        title: 'Tính năng đang được phát triển',
        showConfirmButton: false,
        timer: 1500
    });
    return false;
}

function getToken(messaging){
    if(window.localStorage.getItem('token')) return;
    messaging.requestPermission()
        .then(function () {
            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            console.log(token);
            window.localStorage.setItem('token', token);
        })
        .catch(function (err) {

        });
}

function getNotify(messaging){
    messaging.onMessage(function(payload) {
        console.log("Message received. ", payload);
        $.notify({
            // options
            message: payload.notification.body,
            url: payload.data.url,
        },{
            // settings
            type: "info",
            newest_on_top: true,
            placement: {
                from: "bottom",
                align: "left"
            },
            url_target: '_self',
            delay: 30000,
            timer: 1000,
        });
    });
}

function keypress(evt){
    var keypressed = null;
    if (window.event){
        keypressed = window.event.keyCode; //IE
    } else {
        keypressed = evt.which; //NON-IE, Standard
    }
    if (keypressed < 48 || keypressed > 57) {
        if (keypressed == 8 || keypressed == 127) {
            return true;
        }
        return false;
    }
}

function keypressSpace(evt){
    var keypressed = null;
    if (window.event){
        keypressed = window.event.keyCode; //IE
    } else {
        keypressed = evt.which; //NON-IE, Standard
    }
    if (keypressed == 32) {
        return false;
        }
    return true;
}

$(document).ready(function() {

    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on("click", function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top
                },
                900,
                function() {
                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                }
            );
        } // End if
    });
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-green',
        radioClass   : 'iradio_minimal-green'
    });
    window.onscroll = function() {scrollFunction()};

    // jquery validate config
    $("#registerForm, #registerSocialForm").validate({
        rules: {
            phone : {
                number: true,
                digits: true,
                maxlength: 11
            },
            password : {
                required: true,
                minlength: 8,
                maxlength: 16
            },
            password_confirmation : {
                required: true
            }
        },
        messages: {
            phone : {
                number: "Vui lòng nhập số điện thoại",
                digits: "Vui lòng nhập số điên thoại",
                maxlength: "Số điện thoại không đúng định dạng"
            },
            password : {
                required: "* Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 8 ký tự",
                maxlength: "Mật khẩu tối đa 16 ký tự"
            },
            password_confirmation : {
                required: "* Vui lòng nhập lại mật khẩu"
            }
        }
    });

    $("#loginForm").validate({
        rules: {
            username : {
                required: true,
            },
            password : {
                required: true,
            }
        },
        messages: {
            username : {
                required: "* Vui lòng nhập email/số điện thoại",
            },
            password : {
                required: "* Vui lòng nhập mật khẩu",
            }
        }
    });

    $("#forgetPassForm").validate({
        rules: {
            email : {
                required: true,
                email: true,
            }
        },
        messages: {
            email : {
                required: "* Vui lòng nhập email",
                email: "* Vui lòng nhập email",
            }
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "* Trường bắt buộc",
        email: "Email không đúng định dạng",
        maxlength: jQuery.validator.format("Mật khẩu tối đa {0} ký tự."),
        minlength: jQuery.validator.format("Mật khẩu tối thiểu {0} ký tự."),
        equalTo: 'Xác nhận mật khẩu không khớp'
    });

    // script for modal process
    var loginForm = $("#loginForm");
    var regForm = $("#registerForm");
    var fgPassForm = $("#forgetPassForm");
    var regSocialForm = $("#registerSocialForm");

    if (parseInt($("#userLogin").val()) === 0){
        $("#loginModal").modal('show');
    }

    if (parseInt($("#userRegisterBoth").val()) === 0){
        $("#registerBothModal").modal('show');
    }

    if (parseInt($("#userloginSocial").val()) === 0){
        $("#loginSocialModal").modal('show');
    }

    if (parseInt($("#userlock").val()) === 0){
        $("#userLockModal").modal('show');
    }

    $(".modal .btnSignin").click(function (evt) {
        evt.preventDefault();
        if(loginForm.valid()){
            loginForm.children("p.error").addClass('d-none');
            $.ajax({
                type: "POST",
                url: '/login',
                data: loginForm.serialize() + '&token=' + window.localStorage.getItem('token'),
                success: function(data)
                {
                    switch (data.status) {
                        case 200:
                            window.location = "/";
                            break;
                        case 207:
                            loginForm.children("p.error-password").removeClass('d-none');
                            break;
                        case 209:
                            loginForm.children("p.error-username")
                                .html('Tài khoản chưa được kích hoạt.')
                                .removeClass('d-none');
                            break;
                        case 307:
                            loginForm.children("p.user-lock").removeClass('d-none');
                            break;
                        default:
                            loginForm.children("p.error-username")
                                .html('* Email/SĐT chưa được đăng ký tài khoản.')
                                .removeClass('d-none'); 
                            break;
                    }
                },
                    error: function (data) {
                    fgPassForm.children("p.error-username").html('* Tài khoản không phù hợp, vui lòng kiểm tra lại.')
                        .removeClass('d-none');
                }
            });
        }
    });

    $(".modal .btnRegister").click(function (evt) {
        evt.preventDefault();
        regForm.children("p.error").addClass('d-none');
        if(regForm.valid()){
            $.ajax({
                type: "POST",
                url: '/register',
                data: regForm.serialize(),
                success: function(data)
                {
                    switch (data.status) {
                        case 303: regForm.children("p.error-email").removeClass('d-none'); break;
                        case 304: regForm.children("p.error-phone").removeClass('d-none'); break;
                        case 306: 
                            regForm.children("p.error-email").removeClass('d-none');
                            regForm.children("p.error-phone").removeClass('d-none');
                            break;
                        case 200:
                            Swal.fire({
                                type: 'success',
                                title: 'Đăng ký tài khoản thành công',
                                html: 'Vui lòng thực hiện xác thực tài khoản qua email đã được gửi đến hòm thư của bạn.<br>' +
                                    'Lưu ý: Trong một số trường hợp, email này có thể bị hòm thư của bạn lọc vào thư mục spam. Vì vậy, bạn vui lòng kiểm tra cả thư mục spam.<br>' +
                                    ' Nếu bạn gặp trục trặc trong quá trình đăng ký, xin vui lòng liên lạc với chúng tôi qua hotline 089 664 8544 để được hỗ trợ”',
                                showConfirmButton: true
                            });
                            $('.modal').modal('hide');
                            setTimeout(function redirectLogin() {
                                window.location = "/login";
                            }, 5000);
                            break;
                        default: regForm.children("p.error-general").removeClass('d-none'); break;
                    }
                },
                error: function (data) {
                    regForm.children("p.error-general").removeClass('d-none');
                }
            });
        }
    });

    $(".modal .btnRegisterSocial").click(function (evt) {
        evt.preventDefault();
        regSocialForm.children("p.error").addClass('d-none');
        if(regSocialForm.valid()){ 
            $.ajax({
                type: "POST",
                url: '/registersocial',
                data: regSocialForm.serialize(),
                success: function(data)
                {
                    console.log(data.status)
                    switch (data.status) {
                        case 200: window.location = "/"; break;
                        case 303: regSocialForm.children("p.error-email").removeClass('d-none'); break;
                        case 304: regSocialForm.children("p.error-phone").removeClass('d-none'); break;
                        case 306: 
                            regSocialForm.children("p.error-email").removeClass('d-none');
                            regSocialForm.children("p.error-phone").removeClass('d-none');
                            break;
                        default: regSocialForm.children("p.error-general").removeClass('d-none'); break;
                    }
                },
                error: function (data) {
                    regSocialForm.children("p.error-general").removeClass('d-none');
                }
            });
        }
    });

    $(".modal .btnSendCode").click(function (evt) {
        fgPassForm.children("p.error").addClass('d-none');
        $.ajax({
            type: "get",
            url: '/forget-pass/send-code/'+ fgPassForm.find("input[name='email']").val(),
            success: function(data)
            {
                if (data.status == 305) {
                    fgPassForm.children("p.error-email").removeClass('d-none');
                }
                else if (data.status == 307){
                    fgPassForm.children("p.error-email-lock").removeClass('d-none');
                }
                else if(data.status == 501){
                    fgPassForm.children("p.error-email").html('Vui lòng nhập địa chỉ email').removeClass('d-none');
                }
                else {
                    fgPassForm.find("div.success-notice").removeClass('d-none');
                }
            }
        });
    });

    $(".modal .btnForgetPass").click(function (evt) {
        evt.preventDefault();
        fgPassForm.children("p.error").addClass('d-none');
        if(fgPassForm.valid()) {
            $.ajax({
                type: "post",
                url: '/forget-pass',
                data: fgPassForm.serialize(),
                success: function (data) {
                    if (data.status === 200) {
                        //show popup
                        // console.log('đổi mk thành công');
                        Swal.fire({
                            type: 'success',
                            title: 'Khôi phục mật khẩu thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function redirectLogin() {
                            window.location = "/login";
                        }, 1500);
                    }
                    else {
                        fgPassForm.children("p.error-email").html('Có lỗi xảy ra, vui lòng thử lại')
                          .removeClass('d-none');
                    }
                }
            });
        }
    });

    if (firebase.messaging.isSupported()) {
        const messaging = firebase.messaging();
        getToken(messaging);
        getNotify(messaging);
    }

});
