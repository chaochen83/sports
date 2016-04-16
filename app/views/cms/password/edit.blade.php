@extends('cms.layouts.default')


@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header">更改密码</h3>

        {{ Form::open(array('action' => array('PasswordController@update'), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">原密码</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" name="old_password" placeholder="原密码">
              </div>
            </div>

            <div class="form-group">
              <label for="author" class="col-sm-2 control-label">新密码</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" name="new_password" placeholder="新密码">
              </div>
            </div>

            <div class="form-group">
              <label for="author" class="col-sm-2 control-label">确认新密码</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" name="new_password_confirm" placeholder="确认新密码">
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
