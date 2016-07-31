@extends('pages.layouts.default')

@section('extra_css')
<link type="text/css" rel="stylesheet" href="/css/login.min.css">
@stop

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="/categories/{{ $category->id }}">{{ $category->name }}</a> > {{ $subcategory->name }}
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix">
            <div class="detail">
                <h1 class="title  mb10">{{ $training->title }}</h1>
                <p class="subtitel mb10">
                    <span>讲师：{{ $training->author }}</span>
                    <span>时间：{{ $training->date }}</span>
                    <span>地点：{{ $training->location }}</span>
                    <span>总名额：{{ $training->seats }}</span>
                    <span>剩余名额：{{ $training->seats_left }}</span>
                    <span>学分：{{ $training->score }}</span>
                </p>
                <div class="d-text">
                {{ $training->content }}
                </div>


                <div class="d-btn">
           <!--          {{ Form::open(array('action' => array('TrainingsAttendeesController@store', $training->id), 'class' => '')) }}

                    @if ( ! $history)
                          <button type="submit" class="btn btn-primary  btn-sm">点击报名</button>
                    @else
                          <button type="submit" class="btn btn-primary disabled  btn-sm" disabled="disabled">已经申请过该培训</button>
                    @endif
                    {{ Form::close() }} -->

                    @if ($history)
                        <!-- 已报名按钮，禁用了点击事件 -->
                        <a href="javascript:void(0);" id="signUp" class="btn btn-red mt30 disabled" title="已报名">已报名</a>
                    @elseif ($training->id)
                        <!-- 立即报名按钮，调用AJAX报名 -->
                        <a href="javascript:void(0);" id="signUp" class="btn btn-red mt30" title="立即报名">立即报名</a>
                    @endif
                </div>
            </div>
        </div>
@stop

@section('extra_html')
    <!--  报名弹出框 -->
    <!-- 
        1、请将报名AJAX接口写入form表单的action属性
        2、如果获取到工号则写入id='job'的input中
        3、如有其他参数，请在form内添加 type='hidden'的input
        4、ajax的提交方式使用form表单的method属性
     -->
    <div id="signup-dialog">
        {{ Form::open(array('action' => array('TrainingsAttendeesController@ajaxStore', $training->id), 'id' => 'signup-form')) }}
            <dl class="d-center">
                <dt>请输入工号：</dt>
                <dd>
                    <input type="text" class="aply-ipn" id="job" name="worker_id" value="{{Session::get('user_name') ? Session::get('user_name') : ''}}" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                </dd>
            </dl>
            <div class="d-foot">
                <button type="button" id="btn-ok" class="btn btn-ok">提交</button>
                <button type="button" id="btn-cancel" class="btn btn-cancel">取消</button>
            </div>
        {{ Form::close() }}
    </div>
    <!-- 报名弹出框 end -->
@stop

@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/login.min.js"></script>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        tiyuanFed.detailInit();
    });
</script>
@stop




