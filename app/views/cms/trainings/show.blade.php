@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    <!-- {{{ Session::get('message') or 'Default message!!!!!' }}}  </br>   -->



<!--     TRAINING INFO: </br>
    Title: {{{ $training->title }}} </br>
    Content: {{{ $training->content }}} </br> -->

        <div class="col-md-10 col-md-offset-2 main cms-list">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h3 class="sub-header">培训详情</h3>

          <div class="cms-table no-border">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-20">名称</th>
                  <th class="x-10">介绍</th>
                  <th class="x-10">日期</th>
                  <th class="x-10">主讲人</th>
                  <th class="x-10">培训地点</th>
                  <th class="x-10">限额</th>
                  <th class="x-10">剩余名额</th>
                  <th class="x-10">学分</th>
                  <th class="x-10">操作</th>
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
                  <td>
                    {{ Form::open(array('action' => array('TrainingsAttendeesController@store', $training->id), 'class' => '')) }}

                    @if ( ! $history)
                          <button type="submit" class="btn btn-primary  btn-sm">点击报名</button>
                    @else
                          <button type="submit" class="btn btn-primary disabled  btn-sm" disabled="disabled">已经申请过该培训</button>
                    @endif
                    {{ Form::close() }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- <h2 class="sub-header">培训报名</h2> -->


        </div>

@stop