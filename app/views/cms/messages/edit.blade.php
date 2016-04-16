@extends('cms.layouts.default')

@include('cms.messages.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header">编辑留言</h3>

        {{ Form::open(array('action' => array('MessageController@edit', $message->id), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="message" class="col-sm-2 control-label">留言内容</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="message" placeholder="二级栏目" value="{{ $message->message }}">
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="col-sm-2 control-label">留言人</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="username" placeholder="二级栏目" value="{{ $message->username }}">
              </div>
            </div>

            <div class="form-group">
              <label for="reply" class="col-sm-2 control-label">回复</label>
              <div class="col-sm-6">
                <textarea class="form-control" placeholder="回复" name="reply" cols="50" rows="10">{{ $message->reply }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="reply_author" class="col-sm-2 control-label">回复人</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="reply_author" placeholder="回复人" value="{{ $message->reply_author }}">
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
