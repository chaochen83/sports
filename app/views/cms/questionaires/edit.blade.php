@extends('cms.layouts.default')

@section('content')

@include('cms.questionaires.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          @include('cms.layouts.notice')

          <h2 class="sub-header">编辑问卷调查</h2>

        {{ Form::open(array('action' => array('QuestionairesController@update', $questionaire->id), 'class' => 'filter-form form-horizontal validate', 'id' => 'voteDetailsForm')) }}

            <!-- 投票项的JSON串保存位置 name 可以自定义-->
            <!-- <input type="hidden" name="itmes" id="itmes" value=""> -->
            <input type="hidden" name="itmes" id="itmes" value='{{$jsons}}'>
            <div class="cms-result">
                <!-- table列表 -->
                <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong> 名称：</label>
                    <div class="col-xs-9">
                        <input type="text" name="name" class="validate[required] form-control result-input" value="{{$questionaire->title}}" maxlength="100" placeholder="请输入投票名称">
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong> 开始时间：</label>
                    <div class="col-xs-9">
                        <input type="text" class="validate[required] form-control arial result-input" name="startTime" id="sTime" placeholder="请输入开始时间" value="{{$questionaire->start_time}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong> 结束时间：</label>
                    <div class="col-xs-9">
                        <input type="text" class="validate[required] form-control arial result-input" name="endTime" id="eTime" placeholder="请输入结束时间" value="{{$questionaire->end_time}}" readonly>
                    </div>
                </div>
  <!--              <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong> 是否多选：</label>
                    <div class="col-xs-9">
                        <label class="radio-inline">
                            <input type="radio" name="option" value="1" checked=""> 单选
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="option" value="2"> 多选
                        </label>
                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong> 问卷项：</label>
                    <div class="col-xs-9">
                        <table class="table table-striped table-hover table-condensed table-bordered result-table">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th class="x-40">问卷项标题</th>
                                    <th class="x-50">选项</th>
                                    <th class="x-10">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs ml20 add" title="添加"><i class="glyphicon glyphicon-plus"></i>添加</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <P class="text-danger"><strong><i class="glyphicon glyphicon-alert"></i>“选项”请使用英文逗号“,”分割。例：“非常满意,满意,一般,差,很差”</strong></P>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label"><strong class="text-danger">*</strong>是否启用：</label>
                    <div class="col-xs-9">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="active" {{$questionaire->status == 'active' ? 'checked=""' : ''}} > 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="hide" {{$questionaire->status == 'hide' ? 'checked=""' : ''}}> 否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">备注：</label>
                    <div class="col-xs-9">
                        <textarea name="remark" id="remark" class="form-control  result-textarea" class="validate[maxSize[300]]" placeholder="请输入留言内容，最大不超过300字" maxlength="300" rows="5">{{$questionaire->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-xs-9">
                        <button type="submit" class="btn btn-primary btn-sm">保存</button>
                        <button type="button" class="btn btn-default btn-backtrack">返回</button>
                    </div>
                </div>
            </div>

          {{ Form::close() }}

@stop

@section('extra_css')
    <link href="/css/login.min.css" type="text/css" rel="stylesheet">
@stop

@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/login.min.js"></script>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        CmsTiyuanFed.initVoteDetails();
    });
</script>
@stop