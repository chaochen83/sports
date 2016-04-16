@extends('cms.layouts.default')

@include('cms.locations.sidebar')

@section('content')


        <div class="col-md-10 col-md-offset-2 main cms-list">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')

          <h3 class="sub-header">{{ $location->name }} 已被租用的时间段：</h3>

          <div class="cms-table no-border">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th class="x-40">日期</th>
                  <th class="x-30">开始时间</th>
                  <th class="x-30">结束时间</th>
<!--                   <th>参加人数</th>
                  <th>场地用途</th>
                  <th>租用部门</th>
                  <th>租用人</th>
                  <th>备注</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record->start_date }}</td>
                  <td>{{ $record->start_time }}</td>
                  <td>{{ $record->end_time }}</td><!-- 
                  <td>{{ $record->attendees }}</td>
                  <td>{{ $record->event }}</td>
                  <td>{{ $record->department }}</td>
                  <td>{{ $record->renter }}</td>
                  <td>{{ $record->comment }}</td> -->
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <h3 class="sub-header">申请租用</h3>

        {{ Form::open(array('action' => array('LocationsController@rent', $location->id), 'class' => 'form-horizontal')) }}

            @if (Session::get('user_role') == 'admin')
            <div class="form-group">
              <label for="worker_id" class="col-sm-2 control-label">工号</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="worker_id" placeholder="工号">
              </div>
            </div>
            @endif

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">开始时间</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="start_time" placeholder="开始时间" id="STime">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">结束时间</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="end_time" placeholder="结束时间" id="ETime">
              </div>
            </div>

            <div class="form-group">
              <label for="attendees" class="col-sm-2 control-label">规模 (人数)</label>
              <div class="col-sm-6">
                <input type="number" class="form-control" name="attendees" placeholder="规模">
              </div>
            </div>

            <div class="form-group">
              <label for="department" class="col-sm-2 control-label">租用部门</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="department" placeholder="租用部门">
              </div>
            </div>

            <div class="form-group">
              <label for="renter" class="col-sm-2 control-label">租用人</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="renter" placeholder="租用人">
              </div>
            </div>

            <div class="form-group">
              <label for="event" class="col-sm-2 control-label">用途</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="event" placeholder="用途">
              </div>
            </div>

            <div class="form-group">
              <label for="comment" class="col-sm-2 control-label">备注</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="comment" placeholder="备注">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
              </div>
            </div>

          {{ Form::close() }}
        </div>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        BsCommon.initDoubleDateTime($("#STime"),$("#ETime"),'yyyy-mm-dd hh:ii');
    });
</script>
@stop