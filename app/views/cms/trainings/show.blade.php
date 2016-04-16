@extends('cms.layouts.default')

@section('content')

@include('cms.trainings.sidebar')

    <!-- {{{ Session::get('message') or 'Default message!!!!!' }}}  </br>   -->



<!--     TRAINING INFO: </br>
    Title: {{{ $training->title }}} </br>
    Content: {{{ $training->content }}} </br> -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h2 class="sub-header">培训详情</h2>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>介绍</th>
                  <th>日期</th>
                  <th>主讲人</th>
                  <th>培训地点</th>
                  <th>限额</th>
                  <th>剩余名额</th>
                  <th>学分</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $training->id }}</td>
                  <td>{{ $training->title }}</td>
                  <td>{{ $training->content }}</td>
                  <td>{{ $training->date }}</td>
                  <td>{{ $training->speaker }}</td>
                  <td>{{ $training->location }}</td>
                  <td>{{ $training->seats }}</td>
                  <td>{{ $training->seats_left }}</td>
                  <td>{{ $training->score }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- <h2 class="sub-header">培训报名</h2> -->

        {{ Form::open(array('action' => array('TrainingsAttendeesController@store', $training->id), 'class' => 'form-horizontal')) }}

          @if ( ! $history)
            <div class="form-group">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">点击报名</button>
              </div>
            </div>
          @else
            <div class="form-group">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary disabled">已经申请过该培训</button>
              </div>
            </div>
          @endif
          {{ Form::close() }}

@stop