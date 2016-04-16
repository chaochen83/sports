@extends('cms.layouts.default')

@section('content')

@include('cms.related.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          @include('cms.layouts.notice')

          <h2 class="sub-header">创建友情链接</h2>

        {{ Form::open(array('action' => array('FriendlyController@storeFriendly'), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">友情链接</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="友情链接">
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">网址</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="link" placeholder="网址">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
              </div>
            </div>

          {{ Form::close() }}

@stop
