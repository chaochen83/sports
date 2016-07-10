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
            <div class="main-list i-list-box ">
                <h3 class="title mb20"><span>{{$current_subcategory->name}}</span></h3>
                <ul class="list">
                    @foreach($articles as $article)
                        <li><a href="/news/{{ $article->id }}" target="_blank"><i class="icon"></i>{{ $article->title }}</a><span class="datetime">{{ date('m-d', strtotime($article->date)) }}</span></li>
                    @endforeach
                </ul>
                <!-- 分页 -->
                <div class="pagination mt30">
                    <p>
                        <a href="/categories/{{ $category->id }}">首页</a>

                        <a href="/categories/{{ $category->id }}?page={{$previous_page}}">上一页</a>

                        @for ($page = 1; $page <= $total_pages; $page++)
                            <a href="/categories/{{ $category->id }}?page={{ $page }}" {{ $page == $current_page ? 'class="on"' : ''}}>{{$page}}</a>
                        @endfor

                        <a href="/categories/{{ $category->id }}?page={{$next_page}}">下一页</a>

                        <a href="/categories/{{ $category->id }}?page={{ $total_pages }}">末页</a>
                    </p>
                    <span>{{$start_index}}-{{$end_index}}条，共{{$total_pages}}页</span>
                </div>
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