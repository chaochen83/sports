@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

        <div class="col-md-10 col-md-offset-2 main cms-list cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header"><a class="on">培训列表</a></h3>
          
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-20">名称</th>
                  <!-- <th class="x-10">介绍</th> -->
                  <th class="x-15">日期</th>
                  <th class="x-10">主讲人</th>
                  <th class="x-10">培训地点</th>
                  <!-- <th class="x-10">限报人数</th> -->
                  <th class="x-15">已报/总人数</th>
                  <th class="x-10">学分</th>
                  <th class="x-20">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trainings as $training)
                <tr>
                  <td>{{ $training->id }}</td>
                  <td><a href="/trainings/{{ $training->id }}" target="_blank">{{ $training->title }}</a></td>
                  <!-- <td>{{ mb_substr($training->content, 0, 10) }}</td> -->
                  <td>{{ $training->date }}</td>
                  <td>{{ $training->speaker }}</td>
                  <td>{{ $training->location }}</td>
                  <!-- <td>{{ $training->seats }}</td> -->
                  <td>{{ $training->seats - $training->seats_left }}/{{ $training->seats }}</td>
                  <td><a href="/trainings_attendees/search" >{{ $training->score }}</a></td>
                  <td>
                    <a href="/trainings/{{ $training->id }}/attendees">
                      <span class="glyphicon glyphicon-check" aria-hidden="true" title="报名"></span>
                    </a>
                  @if(Session::get('user_role') == 'admin') 
                    <a href="/trainings/{{ $training->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="编辑培训"></span>
                    </a>
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
