@extends('cms.layouts.default')

@section('content')

@include('cms.related.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">教育部链接列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>教育部链接</th>
                  <th>网址</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sites as $site)
                <tr>
                  <td>{{ $site->id }}</td>
                  <td>{{ $site->name }}</td>
                  <td>{{ $site->link }}</td>
                  <td>
                    <a href="/cms/friendly_sites/{{ $site->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/friendly_sites/{{ $site->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
