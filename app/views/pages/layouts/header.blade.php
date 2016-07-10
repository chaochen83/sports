

        <!-- logo and menu -->
        <div class="head">
            <!-- 20160625 添加学校名称-->
            <div class="title">
		<a href="/">
                	<p class="main">上海体育学院教师发展中心</p>
                	<p class="minor">Center for Faculty Teaching Development of Shanghai University of Sport</p>
		</a>
            </div>        
            <div class="search-box">
                <form id="search" name="search" action="/search" target="_blank" method="get">
                    <input type="text" id="s-box" class="s-box" name="q" value="" placeholder="请输入搜索关键字" />
                    <button type="submit" id="s-submint" class="s-submint"><i class="icon icon-search"></i></button>
                </form>
            </div>
        </div>
@if(strpos($_SERVER['REQUEST_URI'], '/login') === false)
        <!-- 菜单 -->
        <div class="nav-bar tab">
            <div class="nav">
                <a href="/categories/1" target="_self" class="tag">中心简介</a>
                <a href="/categories/2" target="_self" class="tag">教师培训</a>
                <a href="/categories/3" target="_self" class="tag">教学研究</a>
                <a href="/categories/4" target="_self" class="tag">教学资源</a>
                <a href="/categories/5" target="_self" class="tag">教学测评</a>
                <a href="/categories/6" target="_self" class="tag">对话交流</a>
                <a href="/categories/7" target="_self" class="tag">教学督导</a>
            </div>
            <div class="nav-down">
<?php

    // 中心简介：中心概况+发展规划
    $news1 = News::where('subcategory_id', 1)->select('content')->notDeleted()->orderBy('date', 'desc')->first();
    $content_1 = isset($news1->content) ? $news1->content : '';

    $news2 = News::where('subcategory_id', 2)->notDeleted()->get();
?>
                <!-- 中心简介 -->
                <ul class="tab-con hide">
                    <li class="nav-one-img mr20"><img src="../images/pic01.jpg" /></li>
                    <li class="nav-one-details mr20">{{$content_1}}</li>
                    <li class="nav-one-list i-list-box mr20">
                        <ul class="list">
                            @foreach($news2 as $news)
                                <li><a href="/news/{{$news->id}}" target="_blank"><i class="icon"></i>{{$news->title}}</a><span class="datetime">{{ date('m-d', strtotime($news->date)) }}</span></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
<?php
    $categories = Categories::where('id', '<=', 7)->where('id', '>', 1)->get();
?>
    @foreach ($categories as $category) 
                <ul class="tab-con hide">
<?php
        $subcategories = Subcategories::where('category_id', $category->id)->notDeleted()->orderBy('updated_at')->limit(3)->get(); 
?>

        @foreach ($subcategories as $subcategory) 
                    <li class="nav-list i-list-box mr20">
                        <h3 class="title mb20"><span>{{$subcategory->name}}</span></h3>
                        <ul class="list">
<?php
            $articles = News::where('subcategory_id', $subcategory->id)->notDeleted()->orderBy('date', 'desc')->get()
?>                        
            @foreach ($articles as $article)
                            <li><a href="/news/{{$article->id}}" target="_blank"><i class="icon"></i>{{$article->title}}</a><span class="datetime">{{ date('m-d', strtotime($article->date)) }}</span></li>
            @endforeach
                        </ul>
                    </li>
        @endforeach  

                </ul>
    @endforeach
            </div>
        </div>
@endif
