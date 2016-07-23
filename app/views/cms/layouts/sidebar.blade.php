
<div class="col-md-2 sidebar">
    <h3 class="title">个人中心</h3>
    <dl class="subtitle trainings">
        <dt>在线报名</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/trainings' ? 'class="on"' : '') }}><a href="/trainings"><i class="glyphicon glyphicon-list"></i>培训列表</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/trainings_attendees/search' ? 'class="on"' : '') }}><a href="/trainings_attendees/search"><i class="glyphicon glyphicon-list-alt"></i>培训记录</a></dd>
        @if(Session::get('user_role') == 'admin') 
        <dd {{ ($_SERVER['REQUEST_URI'] == '/trainings/create' ? 'class="on"' : '') }}><a href="/trainings/create"><i class="glyphicon glyphicon-plus"></i>新增培训</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/trainings_attendees' ? 'class="on"' : '') }}><a href="/trainings_attendees"><i class="glyphicon glyphicon-briefcase"></i>培训审核</a></dd>
        @endif
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/score_query' ? 'class="on"' : '') }}><a href="/cms/score_query"><i class="glyphicon glyphicon-briefcase"></i>学分查询</a></dd>
    </dl>
    <dl class="subtitle locations">
        <dt>场地预约</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/locations' ? 'class="on"' : '') }}><a href="/locations"><i class="glyphicon glyphicon-list"></i>场地列表</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/search' ? 'class="on"' : '') }}><a href="/locations_rent/search"><i class="glyphicon glyphicon-list-alt"></i>场地查询</a></dd>
        @if(Session::get('user_role') == 'admin') 
        <dd {{ ($_SERVER['REQUEST_URI'] == '/locations/create' ? 'class="on"' : '') }}><a href="/locations/create"><i class="glyphicon glyphicon-plus"></i>新增场地</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/audit' ? 'class="on"' : '') }}><a href="/locations_rent/audit"><i class="glyphicon glyphicon-briefcase"></i>场地审核</a></dd>
        @endif
    </dl>
     @if(Session::get('user_role') == 'admin') 
    <dl class="subtitle categories">
        <dt>栏目设置</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/categories' ? 'class="on"' : '') }}><a href="/cms/categories"><i class="glyphicon glyphicon-list"></i>一级栏目</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/subcategories' ? 'class="on"' : '') }}><a href="/cms/subcategories"><i class="glyphicon glyphicon-list"></i>二级栏目</a></dd>
    </dl>
    @endif
    <dl class="subtitle news">
        <dt>新闻发布</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/news' ? 'class="on"' : '') }}><a href="/cms/news"><i class="glyphicon glyphicon-list"></i>新闻列表</a></dd>
        @if(Session::get('user_role') == 'admin')
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/news/create' ? 'class="on"' : '') }}><a href="/cms/news/create"><i class="glyphicon glyphicon-plus"></i>发布新闻</a></dd>
        @endif
    </dl>
     @if(Session::get('user_role') == 'admin') 
    <dl class="subtitle links">
        <dt>友情链接</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites' ? 'class="on"' : '') }}><a href="/cms/friendly_sites"><i class="glyphicon glyphicon-list"></i>友情链接列表</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites/create' ? 'class="on"' : '') }}><a href="/cms/friendly_sites/create"><i class="glyphicon glyphicon-plus"></i>创建友情链接</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department' ? 'class="on"' : '') }}><a href="/cms/education_department"><i class="glyphicon glyphicon-list"></i>教育部列表</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department/create' ? 'class="on"' : '') }}><a href="/cms/education_department/create"><i class="glyphicon glyphicon-plus"></i>创建教育部链接</a></dd>
    </dl>
     <dl class="subtitle questionaires">
        <dt>问卷调查</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires' ? 'class="on"' : '') }}><a href="/cms/questionaires"><i class="glyphicon glyphicon-list"></i>问卷列表</a></dd>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires/create' ? 'class="on"' : '') }}><a href="/cms/questionaires/create"><i class="glyphicon glyphicon-plus"></i>创建问卷</a></dd>
    </dl>
    @endif
    <dl class="subtitle messages">
        <dt>留言板</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/messages/unreply' ? 'class="on"' : '') }}><a href="/cms/messages/unreply"><i class="glyphicon glyphicon-list"></i>待回复留言</a></dd>
        @if(Session::get('user_role') == 'admin') 
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/messages' ? 'class="on"' : '') }}><a href="/cms/messages"><i class="glyphicon glyphicon-list-alt"></i>全部留言</a></dd>
        @else
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/messages' ? 'class="on"' : '') }}><a href="/cms/messages"><i class="glyphicon glyphicon-list-alt"></i>我回复过的留言</a></dd>
        @endif
    </dl>
    <dl class="subtitle set">
        <dt>账户信息</dt>
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/password/edit' ? 'class="on"' : '') }}><a href="/cms/password/edit"><i class="glyphicon glyphicon-pencil"></i>更改密码</a></dd>
        @if(Session::get('user_role') == 'admin') 
        <dd {{ ($_SERVER['REQUEST_URI'] == '/cms/users' ? 'class="on"' : '') }}><a href="/cms/users"><i class="glyphicon glyphicon-cog"></i>重置密码</a></dd>
        @endif
        <dd><a href="/logout"><i class="glyphicon glyphicon-log-out"></i>登出</a></dd>
    </dl>
</div>