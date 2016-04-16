        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings' ? 'class="active"' : '') }}><a href="/trainings"><i class="glyphicon glyphicon-file"></i> 培训列表</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings_attendees/search' ? 'class="active"' : '') }}><a href="/trainings_attendees/search"><i class="glyphicon glyphicon-file"></i> 培训记录</a></li>
            @if(Session::get('user_role') == 'admin') 
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings/create' ? 'class="active"' : '') }}><a href="/trainings/create"><i class="glyphicon glyphicon-file"></i> 创建培训</a></li>
            <li {{ ($_SERVER['REQUEST_URI'] == '/trainings_attendees' ? 'class="active"' : '') }}><a href="/trainings_attendees"><i class="glyphicon glyphicon-file"></i> 审核培训</a></li>
            @endif
          </ul>
        </div>