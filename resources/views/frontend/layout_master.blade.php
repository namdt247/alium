<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-07-07
 * Time: 10:18
 */
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alium.vn</title>
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="/component/bootstrap4/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/component/slick/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="/component/slick/slick-theme.css"/>
    <link rel="stylesheet" href="/component/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/component/icheck/skins/all.css">
    <link rel="stylesheet" href="/component/select2/css/select2.min.css">
    <link rel="stylesheet" href="/component/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="/component/dropzone/dropzone.css">
    <link rel="stylesheet" href="/component/datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="/css/frontend/style.css?v=1.2">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NB2C7ZN');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NB2C7ZN"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '569300826912183',
            xfbml      : true,
            version    : 'v7.0'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<div id="alium" >

    <div class="menu" style="background-color: #fff;">
        @include('frontend.include.header')
    </div>


<div role="main" class="pt-4">
    @yield('main-content')
</div>

<div id="btn-call">
    <a href="tel:0966994641" title="" class="btn-call" id="btn-call">
        <span class="icon-btn">
            <i class="fa fa-phone"></i>
        </span>
        <span class="hot-line" id="hot-line" style="display: none;">Hotline: 0966 994 641</span>
    </a>    
</div>

@include('frontend.include.footer')
<div id="goTop" onclick="topFunction()" title="Go to top">
    <span class="glyphicon glyphicon-chevron-up"></span>
</div>

@include('frontend.include.register_modal')
@include('frontend.include.login_modal')
@include('frontend.include.fgPass_modal')
</div>

<script src="/component/jquery/jquery-3.4.1.min.js"></script>
<script src="/component/popper/popper.min.js" type="text/javascript" ></script>
<script src="/component/bootstrap4/js/bootstrap.js"></script>
<script src="/component/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/component/jquery-validation/jquery.validate.min.js"></script>
<script src="/component/slick/slick.min.js" type="text/javascript"></script>
<script src="/component/select2/js/select2.full.min.js"></script>
<script src="/component/icheck/icheck.min.js"></script>
<script src="/component/sweetalert2/sweetalert2.all.min.js"></script>
<script src="/component/inputmask/dist/jquery.inputmask.min.js"></script>
<script src="/component/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-messaging.js"></script>
<script src="/js/frontend/script.js"></script>
<script type="text/javascript" src="/js/frontend/order.js?v=1"></script>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v4.0&appId=569300826912183"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.plugins.min.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5806d871e808d60cd070f2a8/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<script>
    $(document).ready(function () {
        $(".city").select2({
            placeholder: 'Hà Nội'
        });

        $(".develop").click(function (evt) {
            showDevelopPopup();
            return false;
        });
        $("img.lazy").Lazy();

        $('#btn-call').mouseover(function() {
            $("#hot-line").css("display","block");
        });
        
        $('#btn-call').mouseout (function() {
            $("#hot-line").css("display","none");
        });
    });

    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyB_oLcjB4O0-eD-D35-yH6gLMi7MgFaJgo",
        authDomain: "alium-240106.firebaseapp.com",
        databaseURL: "https://alium-240106.firebaseio.com",
        projectId: "alium-240106",
        storageBucket: "alium-240106.appspot.com",
        messagingSenderId: "296317457218",
        appId: "1:296317457218:web:554d04193d56423e"
    };
    firebase.initializeApp(config);


</script>
@yield('main-script')
</body>

</html>