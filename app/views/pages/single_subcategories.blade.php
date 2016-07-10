@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                你所在的位置：<a href="/categories/{{ $category->id }}">{{ $category->name }}</a> > {{$current_subcategory->name}}
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix bg-grey">
            <!-- sidebar -->
            <div class="sidebar">
                <h3 class="title">{{ $category->name }}</h3>
                @foreach($subcategories as $subcategory)
                    <a href="/categories/{{ $category->id }}/subcategories/{{ $subcategory->id }}" {{ $subcategory->id == $current_sub_id ? 'class="on"' : '' }}>{{ $subcategory->name }}</a>
                @endforeach
            </div>
            <!-- cen-list -->
            <div class="main-list detail">
            @if(isset($articles[0]))
                <h1 class="title  mb10">{{ $articles[0]->title }}</h1>
                <p class="subtitel mb10">
                    <span>作者：{{ $articles[0]->author }}</span>
                    <span>时间：{{ $articles[0]->date }}</span>
                </p>
                <div class="d-text">
                    {{ $articles[0]->content }}
                </div>
            @endif
            </div>
        </div>
@stop

@section('custom_js')
<script type="text/javascript">
    $(function() {
        tiyuanFed.listInit();
    });
</script>
@stop