@extends('cms.layouts.default')

@section('content')

@include('cms.questionaires.sidebar')

    <div class="main cms-list col-md-9 col-md-offset-3">
        <!-- 标签切换 -->
        <ul class="nav nav-tabs mt10">
            <li role="presentation" class="active"><a>问卷统计图</a></li>
        </ul>
        <!-- 标题 -->
        <div class="cms-collapse">
            <!--  标题 -->
            <h4 class="text-center">{{$questionaire->title}}</h4>
            <p class="text-center">
                <span class="ml10">开始时间：{{$questionaire->start_time}}</span>
                <span class="ml10">结束时间：{{$questionaire->end_time}}</span>
                @if ($questionaire->status == 'active')
                  <!-- 开启样式 -->
                  <span class="ml10">状态：<strong class="text-success">开启</strong></span> 
                @else
                  <!-- 关闭样式 -->
                  <span class="ml10">状态：<strong class="text-danger">关闭</strong></span> 
                @endif
            </p>
            @foreach ($questions as $index => $q)
              <!-- 图表列表 -->
              <div class="panel panel-default">
                  <div class="panel-heading" data-key="{{$q->id}}" data-init="false">
                      <span class="h5">{{$index + 1}}、{{$q->question}}</span>
                      <i class="glyphicon glyphicon-chevron-down pull-right mr10"></i>
                  </div>
                  <div class="panel-body">
                      <!-- 这里的ID是chart+题目的ID -->
                      <div id="chart{{$q->id}}"></div>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
@stop


@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/cms-highcharts.min.js"></script>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        //  统计图表数据
        // CmsTiyuanFed.StatisticsDetailsData = [
        //   {
        //     "options": [
        //     { //题目数组
        //         "name": "非常满意", //问卷选项
        //         "count": 35 //选择人数
        //     }, {
        //         "name": "满意",
        //         "count": 20
        //     }, {
        //         "name": "一般",
        //         "count": 5
        //     }, {
        //         "name": "不满意",
        //         "count": 10
        //     }, {
        //         "name": "非常不满意",
        //         "count": 30
        //     }],
        //     "total": "100",//答题总人数
        //     "title": "你对本次活动的整体评价是？", //问卷题目
        //     "id": "1" //题目ID
        // }, 
        // {
        //     "options": [{
        //         "name": "非常满意",
        //         "count": 15
        //     }, {
        //         "name": "满意",
        //         "count": 10
        //     }, {
        //         "name": "一般",
        //         "count": 35
        //     }, {
        //         "name": "不满意",
        //         "count": 20
        //     }, {
        //         "name": "非常不满意",
        //         "count": 20
        //     }],
        //     "total": "100",
        //     "title": "你对aaaaaaa活动的整体评价是？",
        //     "id": "2"
        // }, 
        // ];
        CmsTiyuanFed.StatisticsDetailsData = {{$jsons}}
        // 初始化方法
        CmsTiyuanFed.initStatisticsDetails();
    });
</script>
@stop
