@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          <h3 class="sub-header"><a class="on">一级栏目列表</a></h3>
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-70">一级栏目名称</th>
                  <th class="x-30">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    <a href="/categories/{{ $category->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a> 
                    <a href="/cms/categories/{{ $category->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/categories/{{ $category->id }}/delete">
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
