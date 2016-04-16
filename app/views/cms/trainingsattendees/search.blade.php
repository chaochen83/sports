@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-md-10 col-md-offset-2 main cms-list">

          <h3 class="sub-header">查询培训记录</h3>

          {{ Form::open(array('action' => array('TrainingsAttendeesController@doSearch'), 'class' => 'form-inline')) }}
            <fieldset class="cms-seach-bar">

            @if (Session::get('user_role') == 'admin')
              <div class="form-group">
                <label for="worker_id" class="control-label">工号</label>
                  <input type="text" id="worker_id" name="worker_id" class="form-control" placeholder="工号" value="" >
              </div>
            @endif

              <div class="form-group">
                <label for="inputEmail3" class="control-label">开始日期</label>
                  <input type="text" class="form-control defTime" name="start_date" placeholder="开始日期" value="{{date('Y-m-d')}}">
              </div>

              <div class="form-group">
                <label for="培训" class="control-label">培训</label>
                  <select id="training" name="training_id" class="form-control">
                      <option value=""></option>
                    @foreach($trainings as $id => $title)
                      <option value="{{$id}}">{{$title}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> 查询</button>
              </div>
              
            </fieldset>
          {{ Form::close() }}

          <!-- <h2 class="sub-header">培训记录</h2> -->

          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-20">培训名称</th>
                  <th class="x-30">培训介绍</th>
                  <th class="x-10">培训日期</th>
                  <th class="x-10">工号</th>
                  <th class="x-5">状态</th>
                @if(Session::get('user_role') == 'admin') 
                  <th class="x-20">操作</th>
                @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->id }}</td>
                  <td>{{ $record->title }}</td>
                  <td>{{ $record->content }}</td>
                  <td>{{ $record->date }}</td>
                  <td>{{ $record->worker_id }}</td>
                  <td>
                    <?php
                      if ($record->status == 'auditing')
                        echo '<span class="label label-warning">审核中</span>';
                      elseif ($record->status == 'approved') 
                        echo '<span class="label label-success">已签到</span>';
                      elseif ($record->status == 'disapproved') 
                        echo '<span class="label label-danger">未通过</span>';
                    ?>
                  </td>
                  <td>
                    @if(Session::get('user_role') == 'admin' && $record->status == 'auditing') 
                    <a href="/trainings_attendees/{{ $record->id }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true">签到</span>
                    </a>
                    <a href="/trainings_attendees/{{ $record->id }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true">旷课</span>
                    </a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
@stop
