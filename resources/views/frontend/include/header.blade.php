<div class="container pt-4">
    <nav id="main-menu" class="main-menu p-0 navbar navbar-expand-lg">
        <a class="navbar-brand" href="{!! route('frontend.home') !!}">
            <img src="/img/1_0006_logo-alium.png" class="d-block mb-1" alt="{!! env('APP_URL') !!}" style="width: 141px">
        </a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <?php $agent = new \Jenssegers\Agent\Agent(); ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link px-md-3 develop" href="#" >
                        @lang('message.header.supplier')<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    @if($agent->is('iPhone'))
                        <a class="nav-link px-md-3" href="https://itunes.apple.com/app/id1483294886"
                            target="_blank">@lang('message.header.downloadApp')</a>
                    @else
                        <a class="nav-link px-md-3" href="https://play.google.com/store/apps/details?id=com.alium.demander"
                            target="_blank">@lang('message.header.downloadApp')</a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link px-md-3" href="{!! route('frontend.article.getList') !!}">@lang('message.header.newsCate')</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-flex">
                    <a class="pl-md-3 py-md-2" href="locale/vi">Vi</a>
                    <span class="divide mt-md-2">&nbsp;|&nbsp;</span>
                    <a class="pr-md-2 py-md-2 font-weight-light develop" href="#">En</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-md-3 pr-md-2" title="@lang('message.header.question')"
                       href="{!! route('frontend.faq.getAdd') !!}">
                        <img class="pt-md-n1" src="/img/information.png" alt="">
                    </a>
                </li>
                <li class="nav-item dropdown notify">
                    @if(Auth::check())
                    <a class="nav-link pl-md-3 pr-md-2" href="#" title="@lang('message.header.notice')" style="position: relative;" data-toggle="dropdown">
                        <?php
                            $notifies = Auth::user()->unreadNotifications()->get();
                            $lstNotify = [];
                            foreach ($notifies as $notify) {
                                if ($notify->data['cate'] == 1) {
                                    array_push($lstNotify, $notify);
                                }
                            }
                            $countNotify = count($lstNotify);
                        ?>
                        <?php if($countNotify > 9) $countNotify = "9+"; ?>
                        <img class="pt-md-n1" src="/img/notification.png" alt="">
                        @if($countNotify > 0)
                            <div style="position: absolute; top: 5px; right: -10px;">
                                <span class="badge badge-pill badge-danger">{!! $countNotify !!}</span>
                            </div>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">@lang('message.header.noticeReceive')</li>
                        <?php
                            $lstNotify = \Illuminate\Notifications\DatabaseNotification::where('notifiable_id', Auth::user()->user_id)
                                ->orderBy('created_at','desc')->get();
                            $notifications = [];
                            foreach ($lstNotify as $notify) {
                                if (count($notifications) < 3) {
                                    if ($notify->data['cate'] == 1) {
                                        array_push($notifications, $notify);
                                    }
                                }
                            }
                        ?>
                        @foreach($notifications as $notification)
                        <li class="p-2" @if(!$notification->read()) style="background-color: #EDF2FA" @endif>
                            <a class="row" href="{!! $notification->data['url'] !!}?notify={!! $notification->id !!}">

                                <div class="col-4">
                                    @if(isset($notification->data['image']))
                                        <img class="img img-fluid" src="{!! $notification->data['image'] !!}"
                                             alt="{!! $notification->data['title'] !!}">
                                    @else
                                        <img class="img img-fluid" src="/img/order-template.png"
                                             alt="{!! $notification->data['title'] !!}">
                                    @endif
                                </div>
                                <div class="col-8 pl-0">
                                    <p class="font-weight-bold">{!! $notification->data['title'] !!}</p>
                                    <p>{!! $notification->data['name'] !!}</p>
                                    <p>{!! $notification->data['message'] !!}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        <li class="footer" style="border-top: 1px solid #dedede; padding: 0.25rem;">
                            <a href="{!! route('frontend.notify.getList') !!}"
                               style="color: #3e9364; text-align: center; display: block; font-size: .875rem;
                            text-transform: none;">
                                @lang('message.header.noticeViewAll')</a>
                        </li>
                    </ul>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-md-3 pr-lg-4 pr-md-2" title="@lang('message.header.order')"
                       href="{!! route('frontend.order.getList') !!}">
                        <img class="pt-md-n1" src="/img/shopping-store-cart-.png" alt="">
                    </a>
                </li>
                @if(Auth::check())
                <li class="nav-item dropdown menu-user">
                    <a class="nav-link pl-md-3 pr-md-2 d-lg-flex align-items-end" href="#" data-toggle="dropdown">
                        <?php
                            $userAvatar = Auth::user()->user_avatar ?
                                \App\Helper\Common::GetThumb(Auth::user()->user_avatar) : asset('img/user_default.png');
                        ?>
                        <img class="img rounded-circle" src="{!! $userAvatar !!}"
                             alt="{!! Auth::user()->user_showName !!}">
                        <span class="ml-2">{!! Auth::user()->user_showName !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="" href="{!! route('frontend.user.getProfile') !!}">
                                @lang('message.header.myAccount')
                            </a>
                        </li>
                        <li>
                            <a class="" href="{!! route('frontend.logout') !!}">
                                @lang('message.header.logout')
                            </a>
                        </li>

                    </ul>
                </li>
                @else
                    <li class="nav-item">
                        <a href="#" class="signin nav-link" data-toggle="modal" data-target="#loginModal"
                           data-dismiss="modal">
                           @lang('message.header.login')</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>