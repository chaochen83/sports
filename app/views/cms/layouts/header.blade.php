    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><strong>绿瓦教学-后台管理系统</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">在线报名 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/trainings">列表</a></li>
                <li><a href="/trainings_attendees/search">记录</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/trainings/create">创建</a></li>
                <li><a href="/trainings_attendees">审核</a></li>
              @endif
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">场地预约 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/locations">列表</a></li>
                <li><a href="/locations_rent/search">查询</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/locations/create">创建</a></li>
                <li><a href="/locations_rent/audit">审核</a></li>
              @endif
              </ul>
            </li>
          @if(Session::get('user_role') == 'admin') 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">栏目 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/categories">一级栏目</a></li>
                <li><a href="/cms/subcategories">二级栏目</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">友情链接 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/friendly_sites">友情链接列表</a></li>
                <li><a href="/cms/friendly_sites/create">创建友情链接</a></li>
                <li><a href="/cms/education_department">教育部列表</a></li>
                <li><a href="/cms/education_department/create">创建教育部链接</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">问卷调查 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/questionaires">问卷调查列表</a></li>
                <li><a href="/cms/questionaires/create">创建问卷调查</a></li>
              </ul>
            </li>
          @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">留言板 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/messages/unreply">待回复留言</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/cms/messages">全部留言</a></li>
              @else
                <li><a href="/cms/messages">我回复过的留言</a></li>
              @endif
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">文章 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/news">列表</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/cms/news/create">创建文章</a></li>
              @endif
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">用户 {{Session::get('user_name')}} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/cms/password/edit">更改密码</a></li>
              @if(Session::get('user_role') == 'admin') 
                <li><a href="/cms/users">重置密码</a></li>
              @endif
                <li><a href="/logout">登出</a></li>
              </ul>
            </li>            
            
          </ul>

        </div>
      </div>
    </nav>