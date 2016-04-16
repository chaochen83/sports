@extends('cms.layouts.default')

@include('cms.locations.sidebar')

@section('content')


<div class="col-md-10 col-md-offset-2 main cms-list">
    <!-- <h1 class="page-header"></h1> -->
    @include('cms.layouts.notice')
    <h3 class="sub-header">等待审核的预约</h3>
    <div class="cms-table no-border">
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
                    <th class="x-5">操作</th>
                </tr>
            </thead>
            <tbody>
                @if (count($records) > 0) @foreach ($records as $record)
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
                @endforeach @endif
            </tbody>
        </table>
    </div>
</div>


@stop