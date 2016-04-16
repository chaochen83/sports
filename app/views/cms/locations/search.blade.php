@extends('cms.layouts.default')

@include('cms.locations.sidebar')

@section('content')


        <div class="col-md-10 col-md-offset-2 main cms-list">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h3 class="sub-header">预约查询</h3>

        {{ Form::open(array('action' => array('LocationsController@search'), 'class' => 'form-inline')) }}
            <fieldset class="cms-seach-bar">
            
            @if (Session::get('user_role') == 'admin')
              <div class="form-group">
                <label for="worker_id" class="control-label">工号</label>
                <input type="text" class="form-control" name="worker_id" placeholder="工号" value="" >
              </div>
            @endif
            
              <div class="form-group">
                <label for="inputEmail3" class="control-label">开始日期</label>
                <input type="text" class="form-control defTime" name="start_date" placeholder="开始日期" value="{{date('Y-m-d')}}">
              </div>

              <div class="form-group">
                <label for="场地" class="control-label">场地</label>
                <select id="location_id" name="location_id" class="form-control">
                    <option value="">请选择</option>
                  @foreach($locations as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> 查询</button>
              </div>
            </fieldset>

          {{ Form::close() }}

          <div class="cms-table">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="x-10">场地</th>
                  <th class="x-10">日期</th>
                  <th class="x-10">开始时间</th>
                  <th class="x-10">结束时间</th>
                  <th class="x-5">参加人数</th>
                  <th class="x-15">场地用途</th>
                  <th class="x-10">租用部门</th>
                  <th class="x-10">租用人</th>
                  <th class="x-15">备注</th>
                  <th class="x-5">状态</th>
                </tr>
              </thead>
              <tbody>
              @if (count($records) > 0)
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->name }}</td>
                  <td>{{ $record->start_date }}</td>
                  <td>{{ $record->start_time }}</td>
                  <td>{{ $record->end_time }}</td>
                  <td>{{ $record->attendees }}</td>
                  <td>{{ $record->event }}</td>
                  <td>{{ $record->department }}</td>
                  <td>{{ $record->renter }}</td>
                  <td>{{ $record->comment }}</td>
                  <td>
                  <?php
                    if ($record->status == 'auditing')
                      echo '<span class="label label-warning">审核中</span>';
                    elseif ($record->status == 'approved') 
                      echo '<span class="label label-success">已批准</span>';
                    elseif ($record->status == 'disapproved') 
                      echo '<span class="label label-danger">未通过</span>';
                  ?>
                  </td>
                </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>


@stop