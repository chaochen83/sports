@extends('cms.layouts.default')

@section('content')

@include('cms.subcategories.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">二级栏目列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>一级栏目</th>
                  <th>二级栏目</th>
                  <th>栏目类型</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subcategories as $subcategory)
                <tr>
                  <td>{{ $subcategory->id }}</td>
                  <td>{{ $subcategory->category }}</td>
                  <td>{{ $subcategory->name }}</td>
                  @if ($subcategory->types == 1)
                    <td>封面</td>
                  @elseif ($subcategory->types == 2)
                    <td>留言板</td>
                  @else
                    <td>列表</td>
                  @endif
                  <td>
                    <a href="/categories/{{ $subcategory->category_id }}/subcategories/{{ $subcategory->id }}" target="_blank">
                      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>  
                    <a href="/cms/subcategories/{{ $subcategory->id }}/edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a href="/cms/subcategories/{{ $subcategory->id }}/delete">
                      <span class="glyphicon glyphicon-trash del" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

@stop
