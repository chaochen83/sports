@extends('cms.layouts.default')

@section('content')

@include('cms.locations.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- <h1 class="page-header"></h1> -->

          @include('cms.layouts.notice')
          
          <h2 class="sub-header">等待审核的预约</h2>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>场地</th>
                  <th>日期</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>参加人数</th>
                  <th>场地用途</th>
                  <th>租用部门</th>
                  <th>租用人</th>
                  <th>备注</th>
                  <th>操作</th>
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
                    <a href="/locations_rent/{{ $record->id }}/approve">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true">同意</span>
                    </a>
                    <a href="/locations_rent/{{ $record->id }}/disapprove">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true">驳回</span>
                    </a>
                  </td>
                </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>

@stop