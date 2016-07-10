          @if (Input::get('success'))
          <div class="alert alert-success" role="alert">
            {{{ Input::get('success') }}}
          </div>
          @elseif (Input::get('error'))
          <div class="alert alert-danger" role="alert">
            {{{ Input::get('error') }}}
          </div>
          @endif