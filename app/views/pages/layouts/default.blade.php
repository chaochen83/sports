<!doctype html>
<html>
<head>
    <meta charset="utf-8">
@if(isset($html_title))
    <title>{{$html_title}}</title>
@else
    <title>教师教学发展中心 - 上海体育学院</title>
@endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="教师发展中心，上海体育学院">
    <meta name="author" content="上海体育学院">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />

    <link type="text/css" rel="stylesheet" href="/css/main.min.css">
    @yield('extra_css')
</head>
<body>
    <!-- topbar -->
    <div class="topbar">
        <div class="center">
            <div class="l-title"><a href="http://www.sus.edu.cn/">上海体育学院</a></div>
            <!-- 未登录  显示如下-->
        @if ( ! Session::get('user_id'))
            <div class="r-login">
                <a href="/login">[登录]</a>
                <span>|</span>
                <a href="/login?a=regsiter">[注册]</a>
            </div>
        @else
            <!-- 已登录 显示如下-->
            <div class="r-login">
                <span>您好：{{Session::get('user_name')}}</span>
                <span>|</span>
                <a href="/cms">[个人中心]</a>
                <span>|</span>
                <a href="/logout">[注销]</a>
            </div>
        @endif
        </div>
    </div>
    <div class="body">
        @include('pages.layouts.header')

        @yield('content')
    </div>

    @include('pages.layouts.footer')

    <!-- 微信客户端浮层 -->
    <div class="erwei hide"><img src="http://placehold.it/120x120&text=Pic001-120*120" /></div>
    <!-- 右侧浮层 -->
    <div class="r-fixed">
        @if ( ! Session::get('user_id'))
        <a href="/login" title="注册登录"><i class="icon icon-login"></i></a>
        @endif
        <a href="/categories/2" title="在线报名"><i class="icon icon-bm"></i></a>
        <a href="/locations_rent/search" title="场地预约"><i class="icon icon-cd"></i></a>
        <a class="rWeixin" href="javascript:void(0);" title="公众号"><i class="icon icon-wx"></i></a>
        <a class="goTop hide" href="javascript:void(0);" title="返回顶部"><i class="icon go-top"></i></a>
    </div>

    @yield('extra_html')

    <script type="text/javascript" charset="utf-8" src="/js/jquery-1.11.3.min.js"></script>
    @yield('extra_js')
    <script type="text/javascript" charset="utf-8" src="/js/main.min.js"></script>
    @yield('custom_js')
</body>

</html>
