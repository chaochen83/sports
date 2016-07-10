        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/messages/unreply' ? 'class="active"' : '') }}><a href="/cms/messages/unreply">待回复留言</a></li>
        @if(Session::get('user_role') == 'admin') 
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/messages' ? 'class="active"' : '') }}><a href="/cms/messages">全部留言</a></li>
        @else
            <li {{ ($_SERVER['REQUEST_URI'] == '/cms/messages' ? 'class="active"' : '') }}><a href="/cms/messages">我回复过的留言</a></li>
        @endif
          </ul>
        </div>