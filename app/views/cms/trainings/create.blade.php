@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    <!-- {{{ Session::get('message') or 'Default message!!!!!' }}}  </br>   -->


        <div class="col-md-10 col-md-offset-2 main cms-list">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h3 class="sub-header">创建培训</h3>

          {{ Form::open(array('action' => array('TrainingsController@store'), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              {{Form::label('名称', '名称', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::text('title', '', array('class' => 'form-control', 'placeholder' => '名称'))}}            
              </div>
            </div>

            <div class="form-group">
              <label for="date" class="col-sm-2 control-label">日期</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="date" placeholder="日期" id="STime">
              </div>
            </div> 

<!--             <div class="form-group">
              <label for="time" class="col-sm-2 control-label">时间</label>
              <div class="col-sm-6">
                <input type="time" class="form-control" name="time" placeholder="时间">
              </div>
            </div>  -->

            <div class="form-group">
              {{Form::label('主讲人', '主讲人', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::text('speaker', '', array('class' => 'form-control', 'placeholder' => '主讲人'))}}            
              </div>
            </div> 

            <div class="form-group">
              {{Form::label('培训地点', '培训地点', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::text('location', '', array('class' => 'form-control', 'placeholder' => '培训地点'))}}            
              </div>
            </div> 

            <div class="form-group">
              {{Form::label('限额', '限额', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::text('seats', '', array('class' => 'form-control', 'placeholder' => '限额'))}}            
              </div>
            </div> 

            <div class="form-group">
              {{Form::label('学分', '学分', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::text('score', '', array('class' => 'form-control', 'placeholder' => '学分'))}}            
              </div>
            </div> 

            <div class="form-group">
              {{Form::label('介绍', '介绍', array('class' => 'col-sm-2 control-label'))}}
              <div class="col-sm-6">
                {{Form::textarea('content', '', array('class' => 'form-control', 'placeholder' => '介绍'))}}            
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
              </div>
            </div>

          {{ Form::close() }}
        </div>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        BsCommon.initDateTime($("#STime"),'yyyy-mm-dd hh:ii')
    });
</script>
@stop