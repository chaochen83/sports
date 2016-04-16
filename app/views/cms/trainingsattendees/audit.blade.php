@extends('cms.layouts.default')

@include('cms.trainings.sidebar')

@section('content')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-md-10 col-md-offset-2 main cms-list">

          <h3 class="sub-header">待审核培训</h3>

          <div class="cms-table no-border">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-20">培训名称</th>
                  <th class="x-30">培训介绍</th>
                  <th class="x-10">培训日期</th>
                  <th class="x-10">工号</th>
                  <th class="x-5">状态</th>
                  <th class="x-20">操作</th>
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
                    @if(Session::get('user_role') == 'admin') 
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
