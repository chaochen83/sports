@extends('cms.layouts.default')

@include('cms.news.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header">编辑文章</h3>

        {{ Form::open(array('action' => array('NewsController@update', $article->id), 'class' => 'form-horizontal', 'files' => true)) }}

            <input type="hidden" name="user_id" value="{{Session::get('user_id')}}">
            
            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">标题</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="title" placeholder="标题" value="{{ $article->title }}">
              </div>
            </div>

            <div class="form-group">
              <label for="author" class="col-sm-2 control-label">作者</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="author" placeholder="作者" value="{{ $article->author }}">
              </div>
            </div>

            <div class="form-group">
              <label for="category_id" class="col-sm-2 control-label">栏目</label>
              <div class="col-sm-6">
                <select class="form-control" name="subcategory_id">
                  @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $article->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                      {{ $subcategory->category.' - '.$subcategory->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="date" class="col-sm-2 control-label">日期</label>
              <div class="col-sm-6">
                <input type="date" class="form-control defTime" name="date" placeholder="作者" value="{{ $article->date }}">
              </div>
            </div>

            <div class="form-group">
              <label for="content" class="col-sm-2 control-label">内容</label>
              <div class="col-sm-10">
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain">
                    {{ $article->content }}
                </script>
                <!-- 配置文件 -->
                <script type="text/javascript" src="/js/rte/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="/js/rte/ueditor.all.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                </script>
              </div>
            </div>

            <div class="form-group">
              <label for="category_id" class="col-sm-2 control-label">培训</label>
              <div class="col-sm-6">
                <select class="form-control" name="training_id">
                    <option value="0" {{ ! $article->training_id ? 'selected' : '' }}></option>
                  @foreach ($trainings as $training)
                    <option value="{{ $training->id }}" {{ $article->training_id == $training->id ? 'selected' : '' }}>{{ $training->title.' - '.$training->date.' '.$training->time }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="document" class="col-sm-2 control-label">附件（5MB）</label>
              <div class="col-sm-6">
                <input type="file" class="form-control" name="document" placeholder="附件">
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
