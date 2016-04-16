@extends('cms.layouts.default')

@include('cms.subcategories.sidebar')

@section('content')

        <div class="col-md-10 col-md-offset-2 main cms-list">

          @include('cms.layouts.notice')

          <h3 class="sub-header">编辑二级栏目</h3>

        {{ Form::open(array('action' => array('SubcategoriesController@update', $subcategory->id), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="category_id" class="col-sm-2 control-label">一级栏目</label>
              <div class="col-sm-6">
                <select class="form-control" name="category_id">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">二级栏目</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="二级栏目" value="{{ $subcategory->name }}">
              </div>
            </div>

            <div class="form-group">
              <label for="types" class="col-sm-2 control-label">栏目类型</label>
              <div class="col-sm-6">
                <div class="radio">
                  <label>
                    <input type="radio" name="types" id="optionsRadios1" value="1" {{ $subcategory->types == '1' ? 'checked' : '' }}>封面
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="types" id="optionsRadios1" value="0" {{ $subcategory->types == '0' ? 'checked' : '' }}>列表
                  </label>
                </div>
<!--                 <div class="radio">
                  <label>
                    <input type="radio" name="types" id="optionsRadios1" value="2" {{ $subcategory->types == '2' ? 'checked' : '' }}>留言
                  </label>
                </div> -->
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
