<?php

class TrainingsAttendeesController extends Controller {

    const PER_PAGE = 20;

    private $worker_id;

    public function __construct()
    {
        $this->beforeFilter('worker', ['except' => ['ajaxStore']]);  // ajaxStore is on "news page" (front) 
        
        $this->worker_id = Input::get('worker_id');

        // $this->beforeFilter('csrf', ['only' => ['store']]);   
    }

    public function index()
    {
        $records = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date'
            )->where('trainings_attendees.status', 'auditing')->orderBy('trainings_attendees.id', 'desc')->get();

        $trainings = Trainings::notDeleted()->lists('title', 'id');

        $data = [];

        $data['records']   = $records;
        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.audit', $data);
    }


    public function approve($id)
    {
        // Auth::admin
        $record = TrainingsAttendees::find($id);

        $user = User::where('worker_id', $record->worker_id)->first();

        if ($record->status == 'auditing')
        {
            $training = Trainings::find($record->training_id);

            User::where('worker_id', $record->worker_id)->increment('accumulated_scores', $training->score);

            TrainingsAttendees::where('id', $id)->update(['status' => 'approved']);

            $message = "审核成功！{$user->name}（工号：{$user->worker_id}） 报名参加的 : {$training->title}，已签到";
        }
        elseif ($record->status == 'approved') {
            $message = '已经审核过了!';
        }
        else  // 之前disapprove过，反悔了改approve
        {
            $training = Trainings::find($record->training_id);

            User::where('worker_id', $record->worker_id)->increment('accumulated_scores', $training->score);

            TrainingsAttendees::where('id', $id)->update(['status' => 'approved']);

            Trainings::where('id', $record->training_id)->decrement('seats_left', 1);

            $message = "审核成功！{$user->name}（工号：{$user->worker_id}） 报名参加的 : {$training->title}，已签到";
        }

        return Redirect::back()->with('message', $message);
    }

    public function disapprove($id)
    {
        // Auth::admin
        $record = TrainingsAttendees::find($id);

        $user = User::where('worker_id', $record->worker_id)->first();

        if ($record->status == 'auditing')
        {
            $training = Trainings::find($record->training_id);

            Trainings::where('id', $record->training_id)->increment('seats_left', 1);

            TrainingsAttendees::where('id', $id)->update(['status' => 'disapproved']);

            $message = "审核成功！{$user->name}（工号：{$user->worker_id}） 报名参加的 : {$training->title}，已记旷课";
        }
        elseif ($record->status == 'disapproved') 
        {
            $message = '已经审核过了!';
        }
        else  // 之前approve过，反悔了改disapprove
        {
            $training = Trainings::find($record->training_id);

            Trainings::where('id', $record->training_id)->increment('seats_left', 1);

            TrainingsAttendees::where('id', $id)->update(['status' => 'disapproved']);

            User::where('worker_id', $record->worker_id)->decrement('accumulated_scores', $training->score);

            $message = "审核成功！{$user->name}（工号：{$user->worker_id}） 报名参加的 : {$training->title}，已记旷课";
        }

        return Redirect::back()->with('message', $message);
    }

    public function delete($id)
    {
        // Auth::admin
        $record = TrainingsAttendees::find($id);

        $user = User::where('worker_id', $record->worker_id)->first();

        $training = Trainings::find($record->training_id);

        if ($record->status == 'approved')
        {
            User::where('worker_id', $record->worker_id)->decrement('accumulated_scores', $training->score);
        }

        TrainingsAttendees::where('id', $id)->delete();

        Trainings::where('id', $record->training_id)->increment('seats_left', 1);

        $message = "删除成功！{$user->name}（工号：{$user->worker_id}） 报名参加的 : {$training->title}，已删除";

        return Redirect::back()->with('message', $message);
    }

    public function store($training_id)
    {
        // if ( ! $this->worker_id) 
        // {
        //     return Redirect::to("trainings/{$training_id}?error=需要工号！");
        // }

        $worker_id = Session::get('user_name');

        if ( ! User::where('worker_id', $worker_id)->first())
        {
            return Redirect::to("trainings?error=工号 {$this->worker_id} 不存在!");
        }

        $history = TrainingsAttendees::where('worker_id', $worker_id)->where('training_id', $training_id)->first();

        if ($history) 
            return Redirect::to("trainings?error={$this->worker_id} 已经申请过此培训!");

        TrainingsAttendees::create([
            'worker_id'   => $worker_id, 
            'training_id' => $training_id,
            ]);

        Trainings::where('id', $training_id)->decrement('seats_left');

        // Flash Data : http://www.golaravel.com/laravel/docs/4.2/responses/#redirects
        return Redirect::to("trainings?success=报名成功")->with('message', 'register success!');
    }

    public function ajaxStore($training_id)
    {
        if ( ! $this->worker_id) 
        {
            return json_encode(['code' => 201, 'message' => '需要工号！']);
        }
        
        if ( ! User::where('worker_id', $this->worker_id)->first())
        {
            return json_encode(['code' => 202, 'message' => "工号 {$this->worker_id} 不存在!"]);
        }

        $history = TrainingsAttendees::where('worker_id', $this->worker_id)->where('training_id', $training_id)->first();

        if ($history) 
            return json_encode(['code' => 203, 'message' => "{$this->worker_id} 已经注册此培训!"]);

        TrainingsAttendees::create([
            'worker_id'   => $this->worker_id, 
            'training_id' => $training_id,
            ]);

        Trainings::where('id', $training_id)->decrement('seats_left');

        return json_encode(['code' => 200, 'message' => '报名成功']);
    }

    public function search()
    {
        $data = [];

        ///////////////
        // Dropdowns //
        ///////////////
        $trainings = Trainings::notDeleted()->orderBy('date', 'desc')->lists('title', 'id');
        // $ended_trainings = Trainings::notDeleted()->isOver()->lists('title', 'id');

        $departments_list = DB::select('SELECT DISTINCT(company)  FROM `users` WHERE company IS NOT null ORDER BY company');

        $data['trainings'] = $trainings;
        // $data['ended_trainings'] = $ended_trainings;
        $data['departments_list'] = $departments_list;

        /////////////
        // Queries //
        /////////////
        if (Session::get('user_role') !== 'admin') {
            $q_worker_id = Session::get('user_name');  // teacher can only query himself
        } else {
            $q_worker_id = null;
        }

        $q_username = Input::get('username');  // admin can search by teacher's name

        $q_start_date = Input::get('start_date');

        $q_training_id = Input::get('training_id');

        $q_ended_training_id = Input::get('ended_training_id'); // removed

        $q_department = Input::get('department');

        ////////////
        // Search //
        ////////////
        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->join('users', 'trainings_attendees.worker_id', '=', 'users.worker_id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.id as training_id',
            'trainings.title',
            'trainings.content',
            'trainings.date',
            'trainings.score',
            'trainings.speaker',
            'trainings.seats',
            'trainings.seats_left',
            'users.name as username'
            );

        if ($q_start_date) $query = $query->where('trainings.date', $q_start_date);

        if ($q_worker_id) $query = $query->where('trainings_attendees.worker_id', $q_worker_id);

        if ($q_training_id and $q_ended_training_id) {
            $query->whereIn('trainings_attendees.training_id', [$q_training_id, $q_ended_training_id]);
        } elseif ($q_training_id) {
            $query = $query->where('trainings_attendees.training_id', $q_training_id);
        } elseif ($q_ended_training_id) {
            $query = $query->where('trainings_attendees.training_id', $q_ended_training_id);
        }

        if ($q_department) {
            $company_worker_ids = User::where('company', $q_department)->lists('worker_id');

            $query = $query->whereIn('trainings_attendees.worker_id', $company_worker_ids);
        }

        if ($q_username) {
            $worker_ids_arr = User::where('name', 'like', '%'.trim($q_username).'%')->lists('worker_id');

            if (count($worker_ids_arr) > 0) {
                $query = $query->whereIn('trainings_attendees.worker_id', $worker_ids_arr);
            } else {
                $query = $query->where('trainings_attendees.worker_id', 'noexists');  // force return empty []
            }

        }

        $records = $query->orderBy('trainings.date', 'desc')->get()->toArray();
        // $records = $query->orderBy('trainings_attendees.created_at', 'desc')->get()->toArray();

        ////////////////
        // Pagination //
        ////////////////
        $data['total_records_count'] = count($records);

        $data['current_page'] = (int) Input::get('page', 1);

        $data['total_pages'] = (int) ceil($data['total_records_count'] / self::PER_PAGE);

        $data['next_page'] = $data['current_page'] >= $data['total_pages'] ? $data['total_pages'] : $data['current_page'] + 1;

        $data['previous_page'] = $data['current_page'] <= 1 ? 1 : $data['current_page'] - 1;

        $data['start_index'] = ($data['current_page'] - 1) * self::PER_PAGE;

        $data['records'] = array_slice($records, $data['start_index'], self::PER_PAGE);

        $data['end_index'] = $data['start_index'] + count($data['records']);

        ////////////////////////
        // For Pagination url //
        ////////////////////////
        $redirect_url = '/trainings_attendees/search?';

        if (Input::get('username')) {
            $redirect_url .= 'username='.Input::get('username').'&';
        }

        if (Input::get('start_date')) {
            $redirect_url .= 'start_date='.Input::get('start_date').'&';
        }

        if (Input::get('training_id')) {
            $redirect_url .= 'training_id='.Input::get('training_id').'&';
        }

        if (Input::get('ended_training_id')) {
            $redirect_url .= 'ended_training_id='.Input::get('ended_training_id').'&';
        }

        if (Input::get('department')) {
            $redirect_url .= 'department='.Input::get('department').'&';
        }

        $data['base_url'] = $redirect_url;


        return View::make('cms.trainingsattendees.search', $data);
    }


    public function doSearch()
    {
        $redirect_url = 'trainings_attendees/search?';

        if (Input::get('username')) {
            $redirect_url .= 'username='.Input::get('username').'&';
        }

        if (Input::get('start_date')) {
            $redirect_url .= 'start_date='.trim(Input::get('start_date')).'&';
        }

        if (Input::get('training_id')) {
            $redirect_url .= 'training_id='.Input::get('training_id').'&';
        }

        if (Input::get('ended_training_id')) {
            $redirect_url .= 'ended_training_id='.Input::get('ended_training_id').'&';
        }

        if (Input::get('department')) {
            $redirect_url .= 'department='.Input::get('department').'&';
        }

        return Redirect::to($redirect_url);
    }

    public function doScoreQuery()
    {
        if (count(Input::all()) == 0) {
            $data['is_landing'] = true;
        } else {
            $data['is_landing'] = false;
        }

        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->join('users', 'users.worker_id', '=', 'trainings_attendees.worker_id')->select(
            'users.name as username',
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date',
            'trainings.score'
            );

        if (Input::get('start_date')) {
            $query = $query->where('trainings.date', '>=', trim(Input::get('start_date')));
        }
        if (Input::get('end_date')) {
            $query = $query->where('trainings.date', '<=', trim(Input::get('end_date')));
        }
        if (Input::get('worker_id')) {
            $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));
        }
        if (Input::get('username')) {
            $query = $query->where('users.name', 'like', '%'.trim(Input::get('username')).'%');
        }

        if ($data['is_landing']) {
            $query = $query->limit(100);
        }

        $data['records'] = $query->orderBy('users.name', 'asc')->orderBy('trainings.date', 'desc')->get();

        return View::make('cms.trainingsattendees.score_query', $data);        
    }


    public function scoreStats()
    {
        $records = [];

        $departments_list = DB::select('SELECT DISTINCT(company)  FROM `users` WHERE company IS NOT null ORDER BY company');

        if (Input::get('start_date')) {
            $start_date = Input::get('start_date');
        } else {
            $start_date = date('Y-m-d');
        }

        $users = User::select('worker_id', 'name', 'company', 'accumulated_scores')->orderBy('name', 'asc');

        if (Input::get('worker_id')) {
            $users = $users->where('worker_id', Input::get('worker_id'));
        }

        if (Input::get('username')) {
            $users = $users->where('name', 'like', '%'.trim(Input::get('username')).'%');
        }

        if (Input::get('department')) {
            $users = $users->where('company', Input::get('department'));
        }

        $users = $users->paginate(self::PER_PAGE);

        foreach ($users as $user) {
            $key = $user->worker_id;
            $records[$key]['worker_id']  = $user->worker_id;
            $records[$key]['username']   = $user->name;
            $records[$key]['department'] = $user->company;   
            $records[$key]['accumulated_score'] = $user->accumulated_scores;   
        }

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $offset = ($current_page - 1) * self::PER_PAGE;

        $total_records = $users->getTotal();

        $total_pages = ceil($total_records / self::PER_PAGE);

        $start_index = $users->getFrom();

        $end_index = $users->getTo();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $url = '/cms/score/statistic?';
        $url = Input::get('start_date') ? $url.'start_date='.trim(Input::get('start_date')).'&' : $url;
        $url = Input::get('end_date') ? $url.'end_date='.trim(Input::get('end_date')).'&' : $url;
        $url = Input::get('department') ? $url.'department='.Input::get('department').'&' : $url;
        $url = Input::get('worker_id') ? $url.'worker_id='.Input::get('worker_id').'&' : $url;
        $url = Input::get('username') ? $url.'username='.trim(Input::get('username')).'&' : $url;

        $data = [
            'q_username'       => Input::get('username', ''),
            'q_worker_id'      => Input::get('worker_id', ''),
            'q_department'     => Input::get('department', ''),
            'q_start_date'     => Input::get('start_date', ''),
            'q_end_date'       => Input::get('end_date', ''),
            'departments_list' => $departments_list,
            'records'          => $records,
            'total_records'    => $total_records,
            'total_pages'      => $total_pages,
            'start_index'      => $start_index,
            'end_index'        => $end_index,
            'current_page'     => $current_page,
            'url'              => $url,
            'previous_page'    => $previous_page,
            'next_page'        => $next_page,
            ];


        return View::make('cms.trainingsattendees.score_stats', $data);        
    }



    public function audit()
    {
        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date'
            );

     
        // Admin can search everyone or no worker_id
        if (Session::get('user_role') == 'admin') {
            if (Input::get('worker_id')) {  // if no worker_id is passed, ignore worker_in where condition:
                $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));
            }
        // Teacher can only search their own:
        } else { 
            $query = $query->where('trainings_attendees.worker_id', Session::get('user_name'));
        }

        // if (Input::get('worker_id')) $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));

        if (Input::get('training_id')) $query = $query->where('trainings_attendees.training_id', Input::get('training_id'));
        
        $records = $query->get();

        $trainings = Trainings::notDeleted()->lists('title', 'id');

        $data = [];

        $data['records']   = $records;
        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.index', $data);        
    }
}
