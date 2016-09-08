<!-- @if (Input::get('success'))
<div class="alert alert-success" role="alert">
{{{ Input::get('success') }}}
</div>
@elseif (Input::get('error'))
<div class="alert alert-danger" role="alert">
{{{ Input::get('error') }}}
</div>
@endif -->
<script type="text/javascript">
@if (Input::get('success'))
  BsCommon.tips("{{{ Input::get('success') }}}",3);
@elseif (Input::get('error'))
  BsCommon.tips("{{{ Input::get('error') }}}",3);
@endif
</script>