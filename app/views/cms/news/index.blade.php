@extends('cms.layouts.default')

@include('cms.news.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list cms-list">

          <h3 class="sub-header">文章列表</h3>
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-40">标题</th>
                  <th class="x-10">一级栏目</th>
                  <th class="x-10">二级栏目</th>
                  <th class="x-10">日期</th>
                  <th class="x-10">作者</th>
                  <th class="x-10">附件</th>
                  <th class="x-10">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($news as $record)
                <tr>
                  <td>{{ $record->id }}</td>
                  <td>{{ $record->title }}</td>
                  <td>{{ $record->category_name }}</td>
                  <td>{{ $record->subcategory_name }}</td>
                  <td>{{ $record->date }}</td>
                  <td>{{ $record->author }}</td>
                  <td>{{ $record->document ? link_to_asset($record->document, '下载', $attributes = array(), $secure = null) : ''}}</td>
                  <td>
                    <a href="/news/{{ $record->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/news/{{ $record->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/news/{{ $record->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="assistant row">
              <div class="total">
                  <span class="text-primary arial">{{$start_index}}-{{$end_index}}</span>
                  <span> / 共</span>
                  <span class="text-primary arial">{{$total_count}}</span>
                  <span>条</span>
              </div>
              <ul class="pagination">
                  <li>
                      <a href="/cms/news?page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="/cms/news?page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="/cms/news?page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>
        </div>
@stop
