@extends('cms.layouts.default')

@include('cms.subcategories.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          <h3 class="sub-header">二级栏目列表</h3>
          <div class="cms-table no-border">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="5">#</th>
                  <th class="x-40">一级栏目</th>
                  <th class="x-40">二级栏目</th>
                  <th class="x-10">栏目类型</th>
                  <th class="x-10">操作</th>
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
        </div>

@stop
