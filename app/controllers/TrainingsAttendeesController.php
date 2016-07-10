<?php

class TrainingsAttendeesController extends Controller {


    private $worker_id;

    public function __construct()
    {
        $this->beforeFilter('worker', ['except' => ['ajaxStore']]);  // ajaxStore is on "news page" (front) 
        
        $this->worker_id = Input::get('worker_id');

        $this->beforeFilter('csrf', ['only' => ['store']]);   
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

        if ($record->status == 'auditing')
        {
            $training = Trainings::find($record->training_id);

            User::where('worker_id', $record->worker_id)->increment('accumulated_scores', $training->score);

            TrainingsAttendees::where('id', $id)->update(['status' => 'approved']);

            $message = 'Operation Successful';
        }
        else
        {
            $message = 'Already audited!';
        }

        return Redirect::back()->with('message', $message);
    }

    public function disapprove($id)
    {
        // Auth::admin

        $record = TrainingsAttendees::find($id);

        if ($record->status == 'auditing')
        {
            Trainings::where('id', $record->training_id)->increment('seats_left', 1);

            TrainingsAttendees::where('id', $id)->update(['status' => 'disapproved']);

            $message = 'Operation Successful';
        }
        else
        {
            $message = 'Already audited!';
        }

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
            return Redirect::to("trainings/{$training_id}?error=工号 {$this->worker_id} 不存在!");
        }

        $history = TrainingsAttendees::where('worker_id', $worker_id)->where('training_id', $training_id)->first();

        if ($history) 
            return Redirect::to("trainings/{$training_id}?error={$this->worker_id} 已经申请过此培训!");

        TrainingsAttendees::create([
            'worker_id'   => $worker_id, 
            'training_id' => $training_id,
            ]);

        Trainings::where('id', $training_id)->decrement('seats_left');

        // Flash Data : http://www.golaravel.com/laravel/docs/4.2/responses/#redirects
        return Redirect::to("trainings/{$training_id}?success=报名成功")->with('message', 'register success!');
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

        // If is normal user, show all of his records
        // If is admin, don't show any record b/c it will be too many:
        if (Session::get('user_role') !== 'admin') 
        {
            // Only search future if not specified:
            if (Input::get('start_date')) {
                $start_date = Input::get('start_date');
            } else {
                $start_date = date('Y-m-d');
            }

            $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
                'trainings_attendees.id', 
                'trainings_attendees.worker_id', 
                'trainings_attendees.status', 
                'trainings.title',
                'trainings.content',
                'trainings.date'
                )->where('trainings.date', '>=', $start_date);
         
            // Admin can search everyone or no worker_id
            if (Session::get('user_role') == 'admin') {
                if (Input::get('worker_id')) {  // if no worker_id is passed, ignore worker_in where condition:
                    $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));
                }
            // Teacher can only search their own:
            } else { 
                $query = $query->where('trainings_attendees.worker_id', Session::get('user_name'));
            }

            if (Input::get('training_id')) $query = $query->where('trainings_attendees.training_id', Input::get('training_id'));
            
            $records = $query->get();

            $data['records']   = $records;

        }
        else
        {
            $data['records']   = [];
        }

        $trainings = Trainings::notDeleted()->notOver()->lists('title', 'id');

        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.search', $data);
    }

    public function doSearch()
    {
        // Only search future if not specified:
        if (Input::get('start_date')) {
            $start_date = Input::get('start_date');
        } else {
            $start_date = date('Y-m-d');
        }

        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date'
            )->where('trainings.date', '>=', $start_date);
     
        // Admin can search everyone or no worker_id
        if (Session::get('user_role') == 'admin') {
            if (Input::get('worker_id')) {  // if no worker_id is passed, ignore worker_in where condition:
                $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));
            }
        // Teacher can only search their own:
        } else { 
            $query = $query->where('trainings_attendees.worker_id', Session::get('user_name'));
        }

        if (Input::get('training_id')) $query = $query->where('trainings_attendees.training_id', Input::get('training_id'));
        
        $records = $query->get();

        $trainings = Trainings::notDeleted()->lists('title', 'id');

        $data = [];

        $data['records']   = $records;
        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.search', $data);
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
