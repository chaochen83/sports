

        <!-- logo and menu -->
        <div class="head">
            <!-- 20160625 添加学校名称-->
            <div class="title">
                <a href="/">
                	<p class="main">上海体育学院教师教学发展中心</p>
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
        <ul class="nav m-center">
            <li class="menu">
                <a href="/" class="tag">首页</a>
            </li>

<?php
            $categories = Categories::where('id', '<=', 7)->get();
?>

            @foreach($categories as $category)
            <li class="menu">
                <a href="/categories/{{$category->id}}" class="tag" target="_self">{{$category->name}}</a>
                <ul class="nav-child">

<?php
                $subcategories = Subcategories::where('category_id', $category->id)->notDeleted()->orderBy('updated_at')->get(); 
?>
                    @foreach($subcategories as $subcategory)
                    <li class="items"><a href="/categories/{{$category->id}}/subcategories/{{$subcategory->id}}" target="_self">{{$subcategory->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
@endif
