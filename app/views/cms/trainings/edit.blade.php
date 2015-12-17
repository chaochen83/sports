@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h2 class="sub-header">编辑培训</h2>

        {{ Form::open(array('action' => array('TrainingsController@update', $training->id), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">名称</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="title" placeholder="名称" value="{{$training->title}}">
              </div>
            </div>

            <div class="form-group">
              <label for="content" class="col-sm-2 control-label">介绍</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="content" placeholder="介绍" value="{{$training->content}}">
              </div>
            </div>

            <div class="form-group">
              <label for="date" class="col-sm-2 control-label">日期</label>
              <div class="col-sm-6">
                <input type="date" class="form-control" name="date" placeholder="日期" value="{{$training->date}}">
              </div>
            </div>

            <div class="form-group">
              <label for="time" class="col-sm-2 control-label">时间</label>
              <div class="col-sm-6">
                <input type="time" class="form-control" name="time" placeholder="时间" value="{{$training->time}}">
              </div>
            </div>

            <div class="form-group">
              <label for="speaker" class="col-sm-2 control-label">主讲人</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="speaker" placeholder="主讲人" value="{{$training->speaker}}">
              </div>
            </div>

            <div class="form-group">
              <label for="location" class="col-sm-2 control-label">培训地点</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="location" placeholder="培训地点" value="{{$training->location}}">
              </div>
            </div>

            <div class="form-group">
              <label for="seats" class="col-sm-2 control-label">限额</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="seats" placeholder="限额" value="{{$training->seats}}">
              </div>
            </div>

            <div class="form-group">
              <label for="score" class="col-sm-2 control-label">学分</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="score" placeholder="学分" value="{{$training->score}}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
              </div>
            </div>

          {{ Form::close() }}

@stop