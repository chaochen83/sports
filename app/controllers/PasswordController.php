<?php

class PasswordController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('worker', ['except' => ['reset']]);
        $this->beforeFilter('admin', ['only' => ['reset']]);

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'rent', 'search']]);   
    }

    public function edit()
    {
        $locations = Locations::notDeleted()->get();

        $data = ['locations' => $locations];

        return View::make('cms.password.edit', $data);
    }

    public function update()
    {
        $old_password = trim(Input::get('old_password'));
        $new_password = trim(Input::get('new_password'));
        $new_password_confirm = trim(Input::get('new_password_confirm'));

        if ($new_password !== $new_password_confirm) return Redirect::to("/cms/password/edit?error=密码不一致！");

        $user_id = Session::get('user_id');

        $user = User::findOrFail($user_id);

        $salt = $user->salt;

        $old_password_encrypted = md5(md5($old_password).$salt);

        if ($old_password_encrypted !== $user->password) return Redirect::to("/cms/password/edit?error=原密码不正确！");

        $new_password_encrypted = md5(md5($new_password).$salt);

        User::where('id', $user_id)->update([
            'password' => $new_password_encrypted
            ]);

        return Redirect::to("/cms/password/edit?success=修改密码成功.");
    }

    public function reset($user_id)
    {
        $new_password = '12345';

        $user = User::findOrFail($user_id);

        $salt = $user->salt;

        $new_password_encrypted = md5(md5($new_password).$salt);

        User::where('id', $user_id)->update([
            'password' => $new_password_encrypted
            ]);

        return Redirect::to("/cms/users?success=重置{$user->worker_id}的密码成功.");
    }

}
