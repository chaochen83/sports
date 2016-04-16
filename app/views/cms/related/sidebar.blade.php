        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites' ? 'class="active"' : '') }}><a href="/cms/friendly_sites"><i class="glyphicon glyphicon-file"></i> 友情链接列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/friendly_sites/create' ? 'class="active"' : '') }}><a href="/cms/friendly_sites/create"><i class="glyphicon glyphicon-file"></i> 创建友情链接</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department' ? 'class="active"' : '') }}><a href="/cms/education_department"><i class="glyphicon glyphicon-file"></i> 教育部链接列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/education_department/create' ? 'class="active"' : '') }}><a href="/cms/education_department/create"><i class="glyphicon glyphicon-file"></i> 创建教育部链接</a></li>
          </ul>
        </div>