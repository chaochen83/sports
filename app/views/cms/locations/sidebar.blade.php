        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations' ? 'class="active"' : '') }}><a href="/locations"><i class="glyphicon glyphicon-file"></i> 列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/search' ? 'class="active"' : '') }}><a href="/locations_rent/search"><i class="glyphicon glyphicon-file"></i> 查询</a></li>
        @if(Session::get('user_role') == 'admin') 
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations/create' ? 'class="active"' : '') }}><a href="/locations/create"><i class="glyphicon glyphicon-file"></i> 创建</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/locations_rent/audit' ? 'class="active"' : '') }}><a href="/locations_rent/audit"><i class="glyphicon glyphicon-file"></i> 审核</a></li>
        @endif
          </ul>
        </div>