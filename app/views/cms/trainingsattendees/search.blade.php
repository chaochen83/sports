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
                  <!-- <input type="text" class="form-control defTime" name="start_date" placeholder="开始日期" value="@if (Input::get('start_date')) {{Input::get('start_date')}} @else {{date('Y-m-d')}}  @endif"> -->
              </div>

              <div class="form-group">
                <label for="培训" class="control-label">未结束的培训</label>
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
                <label for="培训" class="control-label">已结束的培训</label>
                  <select id="training" name="ended_training_id" class="form-control SelectTwo" data-width="180">
                      <option value="">请选择</option>
                    @foreach($ended_trainings as $id => $title)
                     @if (Input::get('ended_training_id') == $id)
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
                  <th width="5">#</th>
                  <th class="x-20">培训名称</th>
                  <th class="x-10">开始日期</th>
                  <th class="x-10">主讲人</th>
                  <th class="x-10">学分</th>
                  <th class="x-15">已申请/总人数</th>
                  <th class="x-10">姓名</th>
                  <th class="x-10">状态</th>
                @if(Session::get('user_role') == 'admin') 
                  <th class="x-15">操作</th>
                @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $record)
                <tr>
                  <td>{{ $record['id'] }}</td>
                  <td>{{ $record['title'] }}</td>
                  <td>{{ $record['date'] }}</td>
                  <td>{{ $record['speaker'] }}</td>
                  <td>{{ $record['score'] }}</td>
                  <td>{{ $record['seats'] - $record['seats_left'] }}/{{ $record['seats'] }}</td>
                  <td>{{ $record['username'] }}</td>
                  <td>
                    <?php
                      if ($record['status'] == 'auditing')
                        echo '<span class="label label-warning">审核中</span>';
                      elseif ($record['status'] == 'approved') 
                        echo '<span class="label label-success">已签到</span>';
                      elseif ($record['status'] == 'disapproved') 
                        echo '<span class="label label-danger">未通过</span>';
                    ?>
                  </td>
                   @if(Session::get('user_role') == 'admin') 
                  <td>
                    @if($record['status'] == 'auditing') 
                    <a href="/trainings_attendees/{{ $record['id'] }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true">签到</span>
                    </a>
                    <a href="/trainings_attendees/{{ $record['id'] }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true">旷课</span>
                    </a>
                    @endif
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