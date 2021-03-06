@extends('cms.layouts.default')

@section('content')

@include('cms.layouts.sidebar')

<div class="col-md-10 col-md-offset-2 main cms-list">
    <!-- <h1 class="page-header"></h1> -->
    @include('cms.layouts.notice')
    <h3 class="sub-header"><a class="on">创建场地</a></h3> 
    {{ Form::open(array('action' => array('LocationsController@store'), 'class' => 'form-horizontal')) }}
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">场地名称</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="name" placeholder="场地名称">
        </div>
    </div>
    <div class="form-group">
        <label for="seats" class="col-sm-2 control-label">规模（人数）</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" name="seats" placeholder="规模（人数）">
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