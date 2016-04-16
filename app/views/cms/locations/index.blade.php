@extends('cms.layouts.default')

@section('content')

@include('cms.locations.sidebar')

    {{{ Session::get('message') }}}  </br>  

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main cms-list">
          <!-- <h1 class="page-header">列表</h1> -->

          <h2 class="sub-header">场地列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>规模</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($locations as $location)
                <tr>
                  <td>{{ $location->id }}</td>
                  <td>{{ $location->name }}</td>
                  <td>{{ $location->seats }}</td>
                  <td>
                    <a href="/locations/{{ $location->id }}">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="预约"></span>
                    </a>
                  @if(Session::get('user_role') == 'admin') 
                    <a href="/locations/{{ $location->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/locations/{{ $location->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  @endif
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
                      <a href="/locations?page={{ $previous_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
                  @for ($page = 1; $page <= $total_pages; $page++)
                    <li {{ $page == $current_page ? 'class="active"' : ''}}><a href="/locations?page={{ $page }}">{{$page}}</a></li>
                  @endfor

                  <li>
                      <a href="/locations?page={{ $next_page }}" data-page="2" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              </ul>
          </div>
@stop
