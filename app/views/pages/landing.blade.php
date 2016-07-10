@extends('pages.layouts.default')

@section('content')
        <!-- top banner -->
        <div class="banner mt20">
            <div class="nivoSlider">
                <a href="#" target="_blank"><img src="../images/banner/banner01.jpg" /></a>
                <a href="#" target="_blank"><img src="../images/banner/banner02.jpg" /></a>
                <a href="#" target="_blank"><img src="../images/banner/banner03.jpg" /></a>
                <a href="#" target="_blank"><img src="../images/banner/banner04.jpg" /></a>
                <a href="#" target="_blank"><img src="../images/banner/banner05.jpg" /></a>
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix">
<?php
    $news_8 = News::where('category_id', 8)->notDeleted()->orderBy('created_at', 'desc')->get();
?>
            <!-- 公告通知  -->
            <div class="i-list-box i-left mr20">
                <h3 class="title mb20"><span><i class="icon icon-horm"></i>公告通知</span><a href="/categories/8" target="_blank" class="more"><i class="icon icon-more"></i></a></h3>
                <ul class="list">
                    @foreach ($news_8 as $article)
                        <li><a href="/news/{{$article->id}}" target="_blank"><i class="icon"></i>{{$article->title}}</a></li>
                    @endforeach
                </ul>
            </div>
<?php
    $news_7 = News::where('category_id', '!=', 8)->notDeleted()->orderBy('created_at', 'desc')->limit(10)->get();
?>
            <!-- 新闻报道  -->
            <div class="i-list-box i-cen mr20">
                <h3 class="title mb20"><span><i class="icon icon-file"></i>新闻报道</span></h3>
                <ul class="list">
                    @foreach ($news_7 as $article)
                        <li><a href="/news/{{$article->id}}" target="_blank"><i class="icon"></i>{{$article->title}}</a><span class="datetime">{{ date('m-d', strtotime($article->date)) }}</span></li>
                    @endforeach
                </ul>
            </div>
            <!-- 按钮列表  -->
            <div class="i-right">
                @if ( ! Session::get('user_id'))
                <a href="/login" target="_blank" class="btn btn-blue mb10">登录/注册</a>
                @else
                <a href="/cms" target="_blank" class="btn btn-blue mb10">个人中心</a>
                @endif
                <a href="/categories/2" target="_blank" class="btn btn-blue mb10">在线报名</a>
                <a href="/locations_rent/search" target="_blank" class="btn btn-blue mb10">场地预约</a>
                <div class="weixin-box">
                    <h3 class="title"><span class="btn btn-weixin">微信教学</span><a href="javascript:void(0);" target="_blank" class="btn btn-blue2 ml10 weixinBtn">客户端</a></h3>
                    <ul class="cen">
                        <li>【护校安园！努力实现中小学校封闭式管理】2015年秋季开学工作暨“护校安园”行动落实情况专项督导报告近日发布，国务院教育督导【护校安园！努力实现中小学校封闭式管理】2015年秋季开学工作暨“护校安园”行动落实情况专项督导报告近日发布，国务院教育督导</li>
                        <li>【护校安园！努力实现中小学校封闭式管理】2015年秋季开学工作暨“护校安园”行动落实情况专项督导报告近日发布，国务院教育督导【护校安园！努力实现中小学校封闭式管理】2015年秋季开学工作暨“护校安园”行动落实情况专项督导报告近日发布，国务院教育督导</li>
                    </ul>
                </div>
            </div>
        </div>
@stop


@section('custom_js')
<script type="text/javascript">
    $(function() {
        tiyuanFed.indexInit();
    });
</script>
@stop