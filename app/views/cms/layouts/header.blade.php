<!-- topbar -->
<div class="topbar">
    <div class="m-center">
        <!-- 已登录 显示如下-->
        <div class="r-login">
            <span>您好：{{Session::get('user_name')}}</span>
            <span>|</span>
            <a href="/logout">[注销]</a>
        </div>
    </div>
</div>
<!-- HEAD -->
<div class="head m-center">
    <div class="title">
      <a href="/">
        <p class="main">上海体育学院教师教学发展中心</p>
        <p class="minor">Center for Faculty Teaching Development of Shanghai University of Sport</p>
      </a>
    </div>
</div>


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