@extends('pages.layouts.default')

@section('extra_css')
<link type="text/css" rel="stylesheet" href="/css/login.min.css">
@stop

@section('content')
    <!-- centre  -->
    <div class="login-main">
        <div class="login-cen tab">
            <h3 class="title ">
                <a href="javascript:void(0);" class="tag on">登录</a>
                <a href="javascript:void(0);" class="tag">注册</a>
            </h3>
            <ul class="tab-box hide show">
                {{ Form::open(array('action' => array('UsersController@doLogin'), 'class' => 'form-horizontal', 'id' => 'loginForm')) }}

                    @if (Input::get('refer'))
                        {{ Form::hidden('refer', Input::get('refer')) }}
                    @endif

                    <li>
                        <span>用户名：</span>
                        <input type="text" name="worker_id" id="worker_id2" value="" maxlength="20" placeholder="请输入用户名" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                    </li>
                    <li>
                        <span>密码：</span>
                        <input type="password" name="password" id="password2" value="" maxlength="20" placeholder="请输入密码" data-validation-engine="validate[required]">
                    </li>
<!--                     <li>
                        <span>验证码：</span>
                        <input type="text" name="captcha" id="captcha2" value="" maxlength="6" placeholder="请输入验证码" class="short" data-validation-engine="validate[required]">
                        <img class="captcha-pic" src="../images/captcha.png" alt="验证码">
                    </li> -->
                    <li>
                        <span></span>
                        <label>
                            <input type="checkbox" name="autoLogin" id="autoLogin" value="true" checked="" class="checkbox"> 下次自动登录
                        </label>
                        <a href="#">忘记密码？</a>
                    </li>
                    <li>
                        <button type="submint" class="btn btn-bule4 btn-ok" title="立即登录">立即登录</button>
                        <a href="/cas_login.php" class="btn btn-red2 ml10" title="前往CAS登录">前往CAS登录</a>
                    </li>

                {{ Form::close() }}
                <!-- </form> -->
            </ul>
            <ul class="tab-box hide">
                {{ Form::open(array('action' => array('UsersController@register'), 'class' => 'form-horizontal', 'id' => 'regsiterForm')) }}

                    @if (Input::get('refer'))
                        {{ Form::hidden('refer', Input::get('refer')) }}
                    @endif
                    
                    <li>
                        <span><em>*</em>用户名：</span>
                        <input type="text" name="worker_id" id="worker_id" value="" maxlength="20" placeholder="请输入用户名" data-validation-engine="validate[required,custom[onlyLetterNumber]]">
                    </li>
                    <li>
                        <span><em>*</em>密码：</span>
                        <input type="password" name="password" id="password" value="" maxlength="20" placeholder="请输入密码" data-validation-engine="validate[required]">
                    </li>
                    <li>
                        <span><em>*</em>确认密码：</span>
                        <input type="password" name="confirm_password" id="confirm_password" value="" maxlength="20" placeholder="请再次输入密码" data-validation-engine="validate[required,equals[password]]">
                    </li>
                    <li>
                        <span><em>*</em>邮箱：</span>
                        <input type="text" name="email" id="email" value="" maxlength="50" placeholder="请输入您的邮箱" data-validation-engine="validate[required,custom[email]]">
                    </li>
                    <li>
                        <span>姓名</span>
                        <input type="text" name="name" id="name" value="" maxlength="4" placeholder="请输入姓名" data-validation-engine="validate[custom[name]]">
                    </li>
                    <li>
                        <span>手机：</span>
                        <input type="text" name="cellphone" id="cellphone" value="" maxlength="11" placeholder="请输入您的手机号码" data-validation-engine="validate[custom[mobile]]">
                    </li>
                    <li>
                        <span>工作单位：</span>
                        <input type="text" name="company" id="company" value="" maxlength="50" placeholder="请输入您工作单位">
                    </li>
<!--                     <li>
                        <span><em>*</em>验证码：</span>
                        <input type="text" name="captcha" id="captcha" value="" maxlength="6" placeholder="请输入验证码" class="short" data-validation-engine="validate[required]">
                        <img class="captcha-pic" src="../images/captcha.png" alt="验证码">
                    </li> -->
                    <li>
                        <button type="submint" class="btn btn-bule3 btn-ok" title="立即注册">立即注册</button>
                    </li>
                {{ Form::close() }}
                <!-- </form> -->
            </ul>
        </div>
    </div>
@stop


@section('extra_js')
<script type="text/javascript" charset="utf-8" src="/js/login.min.js"></script>
@stop

@if (isset($_GET['error']) && $_GET['error'] == 'worker_id_non_exists')
@section('custom_js')
<script type="text/javascript">
    $(function() {
        //不显示弹出框
//	  tiyuanFed.loginlInit();
        // ---------------------------------
        // 显示提示正确信息的弹出框
        // tiyuanFed.loginlInit("ok","登录成功");
        // -------------------------------------
        // 显示提示错误信息的弹出框
          tiyuanFed.loginlInit("error", "工号不存在");
          //tiyuanFed.loginlInit("error", "{{$_GET['error']}}");
    });
</script>
@stop
@endif
