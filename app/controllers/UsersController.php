<?php

class UsersController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['signin', 'register']]);   
    }


    // public function index()
    // {
    //     return User::all();
    // }

    public function doLogin()
    {
        $worker_id = trim(Input::get('worker_id'));
        $password  = trim(Input::get('password'));
        $refer_url = trim(Input::get('refer'));

        $user = User::where('worker_id', $worker_id)->first();

        $password_encrypted = md5(md5($password).$user->salt);

        if ($user->password !== $password_encrypted) return Redirect::to("/login?error=Password incorrect.");

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->worker_id);
        Session::put('user_role', $user->role);

        $redirect_url = $refer_url ? $refer_url : '/';

        return Redirect::to($redirect_url);
    }

    public function register()
    {
        $worker_id = trim(Input::get('worker_id'));
        $email     = trim(Input::get('email'));
        $name      = trim(Input::get('name'));
        $cellphone = trim(Input::get('cellphone'));
        $company   = trim(Input::get('company'));
        $refer_url = trim(Input::get('refer'));

        $check_exists = User::where('worker_id', $worker_id)->first();

        if ($check_exists) return Redirect::to("/login?error=User already exists.");

        $salt = str_random(10);

        $password_encrypted = md5(md5(Input::get('password')).$salt);

        $user = User::create([
            'email'     => $email,
            'worker_id' => $worker_id,
            'password'  => $password_encrypted,
            'salt'      => $salt,
            'name'      => $name,
            'cellphone' => $cellphone,
            'company'   => $company,
            ]); 

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->worker_id);
        Session::put('user_role', 'teacher');

        $redirect_url = $refer_url ? $refer_url : '/';

        return Redirect::to($redirect_url);
    }

    public function login()
    {
        $data = [];
    
        return View::make('pages.login', $data);
    }

    public function casLogin()
    {
        $refer_url = trim(Input::get('refer'));

	session_start();

	if ( ! isset($_SESSION['cas_user'])) return Redirect::to('/'); // not authenticated by cas

	$worker_id = $_SESSION['cas_user']; // cas authenticated, session set, by /cas_login.php

	$user = User::where('worker_id', $worker_id)->first();

	if (!$user) return Redirect::to("/login?error=worker_id_non_exists");

	// Cas Login success:
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->worker_id);
        Session::put('user_role', $user->role);

        $redirect_url = $refer_url ? $refer_url : '/';

        return Redirect::to($redirect_url);
    }	

    public function logout()
    {
        Session::flush();

        return Redirect::to('/');
        //return Redirect::to('/cas_login.php?logout=1');
    }

    public function lists()
    {
        $data['users'] = User::all();

        return View::make('cms.users.list', $data);
    }

    public function cms()
    {
        return Redirect::to('/trainings');
    }

    public function sync()
    {
	session_start();

	$records = $_SESSION['school_teachers'];

	$worker_ids = $records['EMPLOYCODE'];
	$names      = $records['PERSONNAME'];
	$company_codes = $records['ORGCODE'];
	$companys   = $records['ORGNAME'];
	$statuss    = $records['EMPLOYEETYPECODE']; // at school or not

	foreach($worker_ids as $index => $worker_id) {
//		echo $index;
//		echo '</br>';
		$user = User::where('worker_id', $worker_id)->first();

		if ( ! $user) {
			$salt = str_random(10);
			$password_encrypted = md5(md5('12345').$salt);
			User::create([
				'worker_id' => $worker_id,	
				'password' => $password_encrypted,	
				'salt' => $salt,	
				'name' => $names[$index],	
				'company' => $companys[$index],	
				'company_code' => $company_codes[$index],	
				'status' => $statuss[$index],	
			]);

			 echo 'Worker not found! - Index:'.$index.' - Worker_id:'.$worker_id.' - School:'.$names[$index].'</br>';
		}

		if ($user && $user['name'] != $names[$index]){ 
			User::where('worker_id', $worker_id)->update(['name' => $names[$index]]);
			echo 'Name Mismatch ! - Index:'.$index.' - Worker_id:'.$worker_id.' - Our DB:'.$user['name'].' - School:'.$names[$index].'</br>';
		}

		if ($user && $user['company_code'] != $company_codes[$index]){
			User::where('worker_id', $worker_id)->update(['company_code' => $company_codes[$index]]);
			echo 'Company_codes Mismatch ! - Index:'.$index.' - Worker_id:'.$worker_id.' - Our DB:'.$user['company_code'].' - School:'.$company_codes[$index].'</br>';
		}

		if ($user && $user['company'] != $companys[$index]){
			User::where('worker_id', $worker_id)->update(['company' => $companys[$index]]);
			echo 'Company Mismatch ! - Index:'.$index.' - Worker_id:'.$worker_id.' - Our DB:'.$user['company'].' - School:'.$companys[$index].'</br>';
		}

		if ($user && $user['status'] != $statuss[$index]){
			User::where('worker_id', $worker_id)->update(['status' => $statuss[$index]]);
			echo 'Status Mismatch ! - Index:'.$index.' - Worker_id:'.$worker_id.' - Our DB:'.$user['status'].' - School:'.$statuss[$index].'</br>';
		}
	}

	dd('end');
    }
}
