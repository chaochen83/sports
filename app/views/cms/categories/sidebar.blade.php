        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/categories' ? 'class="active"' : '') }}><a href="/cms/categories"><i class="glyphicon glyphicon-file"></i> 一级栏目列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/categories/create' ? 'class="active"' : '') }}><a href="/cms/categories/create"><i class="glyphicon glyphicon-file"></i> 创建一级栏目</a></li>
          </ul>
        </div>