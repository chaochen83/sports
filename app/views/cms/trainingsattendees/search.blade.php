@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

        <div class="col-md-10 col-md-offset-2 main cms-list">

        @if(Session::get('message'))
          <div class="alert alert-success" role="alert">
          {{{ Session::get('message') }}} 
          </div>
        @endif

          <h3 class="sub-header"><a class="on">查询培训记录</a></h3>

          {{ Form::open(array('action' => array('TrainingsAttendeesController@doSearch'), 'class' => 'form-inline')) }}
            <fieldset class="cms-seach-bar">

            @if (Session::get('user_role') == 'admin')
              <div class="form-group">
                <label for="worker_id" class="control-label">姓名</label>
                  <input type="text" id="worker_id" name="username" class="form-control" placeholder="姓名" value="{{Input::get('username')}}" >
              </div>

              <div class="form-group">
                <label for="部门" class="control-label">部门</label>
                  <select id="departments_list" name="department" class="form-control SelectTwo" data-width="30">
                      <option value="">请选择</option>
                    @foreach($departments_list as $department)
                     @if (Input::get('department') == $department->company)
                      <option selected="" value="{{$department->company}}">{{$department->company}}</option>
                     @else
                      <option value="{{$department->company}}">{{$department->company}}</option>
                     @endif
                     
                    @endforeach
                  </select>
              </div>              
            @endif

              <div class="form-group">
                <label for="inputEmail3" class="control-label">培训开始日期</label>
                  <input type="text" class="form-control defTime" name="start_date" placeholder="开始日期" value="@if (Input::get('start_date')) {{Input::get('start_date')}} @endif">
              </div>

              <div class="form-group">
                <label for="培训" class="control-label">培训名称</label>
                  <select id="training" name="training_id" class="form-control SelectTwo" data-width="180">
                      <option value="">请选择</option>
                    @foreach($trainings as $id => $title)
                     @if (Input::get('training_id') == $id)
                      <option selected="" value="{{$id}}">{{$title}}</option>
                     @else
                      <option value="{{$id}}">{{$title}}</option>
                     @endif
                     
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
                  <th class="x-20">培训名称</th>
                  <th class="x-10">培训状态</th>
                  <th class="x-10">开始日期</th>
                  <th class="x-5">学分</th>
                  <th class="x-15">已申请/总人数</th>
                  <th class="x-10">主讲人</th>
                  <th class="x-10">学员姓名</th>
                  <th class="x-10">学员状态</th>
                @if(Session::get('user_role') == 'admin') 
                  <th class="x-15">操作</th>
                @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>

                  @if (mb_strlen($record['title']) > 10)
                  <td><a href="/trainings/{{ $record['training_id'] }}" target="_blank">{{ mb_substr($record['title'], 0, 10).'..' }}</a></td>
                  @else
                  <td>{{$record['title']}}</td>
                  @endif

                  @if ($record['date'] >= date('Y-m-d'))
                  <td><span class="label label-success">正在进行</span></td>
                  @else
                  <td><span class="label label-warning">已结束</span></td>
                  @endif
                  <td>{{ $record['date'] }}</td>
                  <td>{{ $record['score'] }}</td>
                  <td>{{ $record['seats'] - $record['seats_left'] }}/{{ $record['seats'] }}</td>
                  <td>{{ $record['speaker'] }}</td>
                  <td>{{ $record['username'] }}</td>
                  <td>
                    <?php
                      if ($record['status'] == 'auditing')
                        echo '<span class="label label-warning">未签到</span>';
                      elseif ($record['status'] == 'approved') 
                        echo '<span class="label label-success">已签到</span>';
                      elseif ($record['status'] == 'disapproved') 
                        echo '<span class="label label-danger">旷课</span>';
                    ?>
                  </td>
                   @if(Session::get('user_role') == 'admin') 
                  <td>
                    <a href="/trainings_attendees/{{ $record['id'] }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true">签到</span>
                    </a>
                    <a href="/trainings_attendees/{{ $record['id'] }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true">旷课</span>
                    </a>
                    <a href="/trainings_attendees/{{ $record['id'] }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true">删除</span>
                    </a>
                  </td>
                   @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="assistant">
              <div class="total">
                  <span class="text-primary arial">{{$start_index}}-{{$end_index}}</span>
                  <span> / 共</span>
                  <span class="text-primary arial">{{$total_records_count}}</span>
                  <span>条</span>
              </div>
              <ul class="pagination">
                  <li>
                      <a href="{{ $base_url }}page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="{{ $base_url }}page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="{{ $base_url }}page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>

        </div>
@stop
@section('custom_js')
<script type="text/javascript">
    $(function() {
        BsCommon.setSelectTwo("SelectTwo");
    });
</script>
@stop