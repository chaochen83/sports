@extends('pages.layouts.default')

@section('content')
        <!-- 导航菜单 -->
        <div class="subnav mt20">
            <div>
                搜索关键字<strong class="red-text">{{$q}}</strong>共搜索到{{$results_count}}条记录
            </div>
        </div>
        <!-- centre  -->
        <div class="centre mt20 clearfix bg-grey">
            <!-- cen-list -->
            <div class="main-list search-list i-list-box ">
                <h3 class="title mb20"><span>搜索结果</span></h3>
                <ul class="list">
                    @foreach($results as $result)
                        <li><a href="/news/{{$result->id}}" target="_blank"><i class="icon"></i>{{$result->title}}</a><span class="datetime">{{ date('m-d', strtotime($result->date)) }}</span></li>
                    @endforeach
                </ul>
                <!-- 分页 -->
                <div class="pagination mt30">
                    <p>
                        <a href="/search?q={{$q}}">首页</a>
                        <a href="/search?q={{$q}}&page={{$previous_page}}">上一页</a>
                        @for ($page = 1; $page <= $total_pages; $page++)
                            <a href="/search?q={{$q}}&page={{$page}}" {{ $page == $current_page ? 'class="on"' : ''}}>{{$page}}</a>
                        @endfor
                        <a href="/search?q={{$q}}&page={{$next_page}}">下一页</a>
                        <a href="/search?q={{$q}}&page={{$total_pages}}">末页</a>
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