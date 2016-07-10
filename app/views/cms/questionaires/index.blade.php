@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

        <div class="col-md-10 col-md-offset-2 main cms-list cms-list">

          <h3 class="sub-header"><a class="on">问卷调查列表</a></h3>
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="x-60">标题</th>
                  <th class="x-10">开始时间</th>
                  <th class="x-10">结束时间</th>
                  <th class="x-10">状态</th>
                  <th class="x-10">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($questionaires as $q)
                <tr>
                  <td>{{ $q->title }}</td>
                  <td>{{ $q->start_time }}</td>
                  <td>{{ $q->end_time }}</td>
                  <td>{{ $q->status == 'active' ? '开启' : '关闭' }}</td>
                  <td>
                    <a href="/questionaires/{{ $q->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/questionaires/{{ $q->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/questionaires/{{ $q->id }}/stats">
                      <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/questionaires/{{ $q->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
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
                      <a href="/cms/questionaires?page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="/cms/questionaires?page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="/cms/questionaires?page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>
        </div>

@stop
