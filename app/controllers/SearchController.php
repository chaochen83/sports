<?php

class SearchController extends Controller {

    const PER_PAGE = 20;
    
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => []]);   
    }

    public function show()
    {
        $q = Input::get('q');

        if ( ! $q) return Redirect::back();

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $offset = ($current_page - 1) * self::PER_PAGE;

        $results_count = News::where('title', 'like', "%{$q}%")->orWhere('content', 'like', "%{$q}%")->notDeleted()->orderBy('date', 'desc')->count();

        $results = News::where('title', 'like', "%{$q}%")->orWhere('content', 'like', "%{$q}%")->notDeleted()->orderBy('date', 'desc')->get();

        $total_pages = ceil($results_count / self::PER_PAGE);
    
        $start_index = $offset + 1;
        $end_index   = $offset + count($results);

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);
        $next_page     = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);


        // $data['q']             = $q;
        // $data['results']       = $results;
        // $data['results_count'] = $results_count;
        $data = [
            'q'             => $q, 
            'results'       => $results,
            'results_count' => $results_count,
            'total_pages'   => $total_pages,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];
            
        return View::make('pages.search', $data); // return View('pages.about');
    }

    public function attendees($worker_id)
    {
        // Auth::check
        
        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->where('trainings_attendees.worker_id', $worker_id);

        $query = $this->start_date ? $query->where('trainings.date', '>=', $this->start_date) : $query;

        $query = $this->end_date ? $query->where('trainings.date', '<=', $this->end_date) : $query;

        $query = $this->training_title ? $query->where('trainings.title', 'like', "%{$this->training_title}%") : $query;

        $records = $query->get();

        return $records;
    }

}
