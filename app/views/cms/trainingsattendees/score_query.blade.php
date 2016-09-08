@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')
  <div class="col-md-10 col-md-offset-2 main cms-list">
      <!-- 20160624  添加Ttab -->
      <h2 class="sub-header">
          <a class="on" href="/trainings">学分查询</a>
      </h2>
        {{ Form::open(array('action' => array('TrainingsAttendeesController@doScoreQuery'), 'class' => 'form-inline')) }}
          <div class="cms-seach-bar">
              <div class="form-group">
                  <label for="inputEmail3" class="control-label">日期：</label>
                  
                  <input type="text" class="form-control" id="startTime" name="start_date" placeholder="开始日期" value="@if (Input::get('start_date')) {{Input::get('start_date')}} @else {{date('Y-m-d')}}  @endif" readonly="">
                  <span>-</span>
                  <input type="text" class="form-control" id="endTime" name="end_date" placeholder="结束日期" value="{{Input::get('end_date')}}" readonly="">
              </div>
            @if(Session::get('user_role') == 'admin') 
              <div class="form-group">
                  <label for="培训" class="control-label">工号：</label>
                  <input type="text" class="form-control" name="worker_id" placeholder="请输入工号" value="{{Input::get('worker_id')}}">
              </div>
            @else
              <input type="hidden" name="worker_id" value="<?php echo Session::get('user_name'); ?>">
            @endif
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> 查询</button>
              </div>
          </div>
        {{ Form::close() }}
      <div class="cms-table no-border">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th width="5">#</th>
                      <th class="x-20">工号</th>
                      <th class="x-35">培训名称</th>
                      <th class="x-25">培训日期</th>
                      <th class="x-10">状态</th>
                      <th class="x-10">学分</th>
                  </tr>
              </thead>
              <tbody>
<?php
  $total_score = 0;
?>
              @if(isset($records))
                @foreach($records as $key => $record)
                  <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$record->worker_id}}</td>
                      <td>{{$record->title}}</td>
                      <td>{{$record->date}}</td>
                    @if($record->status == 'approved')
                      <td><span class="label label-success">已签到</span></td>
                      <td>{{$record->score}}</td>
<?php $total_score += $record->score?>                      
                    @elseif($record->status == 'disapproved')
                      <td><span class="label label-danger">未签到</span></td>
                      <td>0</td>
                    @elseif($record->status == 'auditing')
                      <td><span class="label label-warning">审核中</span></td>
                      <td>0</td>
                    @endif
                  </tr>
                @endforeach
              @endif
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="5" class="text-right"><strong>获得总学分：</strong></td>
                      <td><strong>{{$total_score}}</strong></td>
                  </tr>
              </tfoot>
          </table>
      </div>
  </div>

@stop
