@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

        <div class="col-md-10 col-md-offset-2 main cms-list cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header"><a class="on">培训列表</a></h3>
       
          {{ Form::open(array('action' => array('TrainingsController@searchIndex'), 'class' => 'form-inline')) }}
            <fieldset class="cms-seach-bar">

              <div class="form-group">
                <label for="worker_id" class="control-label">培训名称</label>
                  <input type="text" id="worker_id" name="training_title" class="form-control" placeholder="培训名称" value="{{Input::get('training_title')}}" >
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="control-label">培训日期</label>
                  <input type="text" class="form-control defTime" name="start_date" placeholder="开始日期" value="@if (Input::get('start_date')) {{Input::get('start_date')}} @endif">
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> 查询</button>
              </div>
              
            </fieldset>
          {{ Form::close() }}


          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="x-20">名称</th>
                  <th class="x-10">状态</th>
                  <th class="x-10">日期</th>
                  <th class="x-10">主讲人</th>
                  <th class="x-10">地点</th>
                  <th class="x-15">已报/总人数</th>
                  <th class="x-10">状态</th>
                  <th class="x-20">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trainings as $training)
                <tr>

                  @if (mb_strlen($training->title) > 10)
                  <td><a href="/trainings/{{ $training->id }}" target="_blank">{{ mb_substr($training->title, 0, 10).'..' }}</a></td>
                  @else
                  <td><a href="/trainings/{{ $training->id }}" target="_blank">{{$training->title}}</a></td>
                  @endif

                  @if ($training->date >= date('Y-m-d'))
                  <td><span class="label label-success">正在进行</span></td>
                  @else
                  <td><span class="label label-warning">已结束</span></td>
                  @endif                  
                  <td>{{ $training->date }}</td>
                  <td>{{ $training->speaker }}</td>
                  <td>{{ $training->location }}</td>
                  <td><a href="/trainings_attendees/search?training_id={{$training->id}}&" >{{ $training->seats - $training->seats_left }}/{{ $training->seats }}（{{$training->score}}学分）</a></td>

                  <td>
                  @if (in_array($training->id, $attended_trainings))
                  已报名
                  @else
                  未报名
                  @endif
                  </td>

                  <td>
                  @if ($training->date >= date('Y-m-d'))

                    @if ( ! in_array($training->id, $attended_trainings))
                    <a href="/trainings/{{ $training->id }}/attendees">
                      <span class="glyphicon glyphicon-check" aria-hidden="true" title="报名"></span>
                    </a>
                    @endif

                    @if(Session::get('user_role') == 'admin') 
                    <a href="/trainings/{{ $training->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="编辑培训"></span>
                    </a>
                    @endif

                  @endif

                    @if(Session::get('user_role') == 'admin') 
                    <a href="/trainings/{{ $training->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true" title="删除培训"></span>
                    </a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


          <div class="assistant">
              <div class="total">
                  <span class="text-primary arial">{{$start_index}}-{{$end_index}}</span>
                  <span> / 共</span>
                  <span class="text-primary arial">{{$total_count}}</span>
                  <span>条</span>
              </div>
              <ul class="pagination">
                  <li>
                      <a href="/trainings?page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="/trainings?page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="/trainings?page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>
        </div>
@stop
