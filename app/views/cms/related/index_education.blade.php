@extends('cms.layouts.default')

@include('cms.related.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          <h3 class="sub-header">教育部链接列表</h3>
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-50">教育部链接</th>
                  <th class="x-40">网址</th>
                  <th class="x-10">操作</th>
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
        </div>

@stop
