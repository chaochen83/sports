        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires' ? 'class="active"' : '') }}><a href="/cms/questionaires"><i class="glyphicon glyphicon-file"></i> 问卷调查列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/questionaires/create' ? 'class="active"' : '') }}><a href="/cms/questionaires/create"><i class="glyphicon glyphicon-file"></i> 创建问卷调查</a></li>
          </ul>
        </div>