@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

<div class="col-md-10 col-md-offset-2 main cms-list">
    <!-- 20160624  添加Ttab -->
    <h2 class="sub-header">
        <a class="on" href="/trainings">学分统计</a>
    </h2>
    {{ Form::open(array('action' => array('TrainingsAttendeesController@scoreStats'), 'class' => 'form-inline')) }}
        <div class="cms-seach-bar">
            @if (Session::get('user_role') == 'admin')
              <div class="form-group">
                <label for="worker_id" class="control-label">工号</label>
                  <input type="text" id="worker_id" name="worker_id" class="form-control" placeholder="工号" value="" >
              </div>
            @endif
            <div class="form-group">
                <label for="name" class="control-label">部门：</label>
                <select name="department" id="" class="form-control">
                    @foreach($departments_list as $d)
                    <option value="{{$d->company}}">{{$d->company}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="control-label">日期：</label>
                <input type="text" class="form-control" id="startTime" name="start_date" placeholder="开始日期" value="" readonly="">
                <span>-</span>
                <input type="text" class="form-control" id="endTime" name="end_date" placeholder="结束日期" value="" readonly="">
            </div>
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
                    <th class="x-20">姓名</th>
                    <th class="x-20">部门</th>
                    <th class="x-25">开始日期</th>
                    <th class="x-25">结束日期</th>
                    <th class="x-10">总学分</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td></td>
                    <td><a href="/cms/score_query?worker_id={{$record['worker_id']}}">{{ $record['username'] }}</a></td>
                    <td>{{ $record['department'] }}</td>
                    <td>{{ $record['start_date'] }}</td>
                    <td>{{ $record['end_date'] }}</td>
                    <td>{{ $record['accumulated_score'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--最下面的分页器-->
    <div class="assistant">
        <div class="total">
            <span class="text-primary arial">{{$start_index}}-{{$end_index}}</span>
            <span> / 共</span>
            <span class="text-primary arial">{{$total_records}}</span>
            <span>条</span>
        </div>
        <ul class="pagination">
            <li class="">
                <a href="{{$url.'&page='.$previous_page}}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="active"><a href="{{$url.'&page=1'}}">1</a></li>
            <!-- <li><a href="javascript:void(0);" data-page="2">2</a></li> -->
            <li class="disabled"><a href="#">...</a></li>
            <!-- <li class="active"><a href="{{$url.'&page='.$previous_page}}">{{$previous_page}}</a></li> -->
            <li class="active"><a href="{{$url.'&page='.$current_page}}">{{$current_page}}</a></li>
            <!-- <li class="active"><a href="{{$url.'&page='.$next_page}}">{{$next_page}}</a></li> -->
            <li class="disabled"><a href="#">...</a></li>
            <!-- <li><a href="javascript:void(0);" data-page="99">99</a></li> -->
            <li class="active"><a href="{{$url.'&page='.$total_pages}}">{{$total_pages}}</a></li>
            <li>
                <a href="{{$url.'&page='.$next_page}}" data-page="2" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                <input type="hidden" name="page" value="">
            </li>
        </ul>
    </div>
</div>

@stop
