@extends('cms.layouts.default')

@include('cms.categories.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header">创建一级栏目</h3>

        {{ Form::open(array('action' => array('CategoriesController@store'), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">一级栏目</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="一级栏目">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
              </div>
            </div>

          {{ Form::close() }}
        </div>

@stop
