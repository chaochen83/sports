@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

          @include('cms.layouts.notice')

        <div class="col-md-10 col-md-offset-2 main cms-list">
          {{{ Session::get('message') }}}
          <h3 class="sub-header"><a class="on">重置密码</a></h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>工号</th>
                  <th>用户名</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $user->worker_id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>
                    <a href="/cms/users/{{$user->id}}/password/reset">
                      <span class="glyphicon glyphicon-wrench" aria-hidden="true">重置密码</span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

@stop
