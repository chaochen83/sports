<?php

class LocationsController extends Controller {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('worker');
        
        // $this->beforeFilter('csrf', ['only' => ['store', 'update', 'search']]);   
    }


    public function index()
    {
        $locations = Locations::notDeleted()->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $locations->getLastPage();

        $total_count = $locations->getTotal();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $locations->getFrom();

        $end_index = $locations->getTo();

        $data = [
            'locations'     => $locations,
            'total_pages'   => $total_pages,
            'total_count'   => $total_count,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

        return View::make('cms.locations.index', $data);
    }


    public function create()
    {
        return View::make('cms.locations.create');
    }


    public function store()
    {
        try 
        {
            Locations::create([
                'name'   => Input::get('name'),
                'seats'  => Input::get('seats'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location store] '.$e->getMessage());

            return Redirect::to("locations/create?error=参数有误!");
        }

        return Redirect::to("locations/create?success=创建成功");
    }


    public function edit($id)
    {
        $location = Locations::find($id);

        $data = ['location' => $location];

        return View::make('cms.locations.edit', $data);
    }


    public function update($id)
    {
        try 
        {
            Locations::where('id', $id)->update([
                'name'  => Input::get('name'),
                'seats' => Input::get('seats'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location update] '.$e->getMessage());

            return Redirect::to("locations/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("locations/{$id}/edit?success=编辑成功");
    }


    public function show($location_id)
    {
        $data = [];

        $departments_list = DB::select('SELECT DISTINCT(company)  FROM `users` WHERE company IS NOT null ORDER BY company');

        $locations_rent = LocationsRent::where('location_id', $location_id)->where('start_date', '>=', date('Y-m-d'))->approved()->orderBy('start_date')->orderBy('start_time')->get();

        $location = Locations::find($location_id);
        
        $data['records']  = $locations_rent;
        $data['user']  = User::find(Session::get('user_id'));
        $data['location'] = $location;
        $data['departments_list'] = $departments_list;

        return View::make('cms.locations.show', $data);
    }


    // public function searchForm()
    // {
    //     $locations = Locations::notDeleted()->lists('name', 'id');

    //     $data = [];

    //     $data['locations'] = $locations;
    //     $data['records']   = [];

    //     return View::make('cms.locations.search', $data);
    // }


    public function search()
    {
        $locations = Locations::notDeleted()->orderBy('name', 'asc')->lists('name', 'id');

        $data = [];

        $query = LocationsRent::join('locations', 'locations_rent.location_id', '=', 'locations.id')->select('locations_rent.*', 'locations.name');
     
        // Admin can search everyone or no worker_id
        if (Session::get('user_role') == 'admin') {
            if (Input::get('worker_id')) {  // if no worker_id is passed, ignore worker_in where condition:
                $query = $query->where('locations_rent.worker_id', Input::get('worker_id'));
            }
        // Teacher can only search their own:
        } else { 
            $query = $query->where('locations_rent.worker_id', Session::get('user_name'));
        }

        if (Input::get('location_id')) $query = $query->where('locations.id', Input::get('location_id'));

        if (Input::get('start_date')) $query = $query->where('locations_rent.start_date', '>=', Input::get('start_date'));

        if (Input::get('username')) $query = $query->where('locations_rent.renter', 'like', '%'.trim(Input::get('username')).'%');

        $records = $query->orderBy('locations_rent.start_date', 'desc')->orderBy('locations_rent.start_time', 'desc')->paginate(self::PER_PAGE);

        $data['locations'] = $locations;
        $data['records']   = $records;

        ////////////////
        // Pagination //
        ////////////////
        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $offset = ($current_page - 1) * self::PER_PAGE;

        $total_records = $records->getTotal();

        $total_pages = ceil($total_records / self::PER_PAGE);

        $start_index = $records->getFrom();

        $end_index = $records->getTo();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $url = '/locations_rent/search?';
        $url = Input::get('start_date') ? $url.'start_date='.trim(Input::get('start_date')).'&' : $url;
        $url = Input::get('location_id') ? $url.'location_id='.Input::get('location_id').'&' : $url;
        $url = Input::get('worker_id') ? $url.'worker_id='.Input::get('worker_id').'&' : $url;
        $url = Input::get('username') ? $url.'username='.trim(Input::get('username')).'&' : $url;

        $data = [
            'locations' => $locations,
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

        return View::make('cms.locations.search', $data);
    }


    public function audit()
    {
        $data = [];

        $records = LocationsRent::join('locations', 'locations_rent.location_id', '=', 'locations.id')->where('locations_rent.status', 'auditing')->select('locations_rent.*', 'locations.name')->orderBy('locations_rent.start_date')->orderBy('locations_rent.start_time')->get();

        $data['records'] = $records;

        return View::make('cms.locations.audit', $data);
    }


    public function approve($id)
    {
        LocationsRent::where('id', $id)->update(['status' => 'approved']);

        return Redirect::to("locations_rent/audit?success=审核通过");
    }


    public function disapprove($id)
    {
        LocationsRent::where('id', $id)->update(['status' => 'disapproved']);

        return Redirect::to("locations_rent/audit?success=审核不通过！");
    }




    public function rent($location_id)
    {

        // Teacher can only search their own:
        if (Session::get('user_role') == 'admin') {
            $worker_id = Input::get('worker_id');
            $renter = Input::get('renter');
        } else {
            $user = User::find(Session::get('user_id'));

            $worker_id = Session::get('user_name');
            $renter = $user->name;
        }

        try 
        {
            LocationsRent::create([
                'location_id' => $location_id, 
                'worker_id'   => $worker_id,
                'start_date'  => date('Y-m-d', strtotime(Input::get('start_time'))),
                'start_time'  => date('H:i:s', strtotime(Input::get('start_time'))),
                'end_time'    => date('H:i:s', strtotime(Input::get('end_time'))),
                'attendees'   => (int)Input::get('attendees'),
                'department'  => Input::get('department'),
                'renter'      => $renter,
                'event'       => Input::get('event'),
                'comment'     => Input::get('comment'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location Rent] '.$e->getMessage());

            return Redirect::to("locations/{$location_id}?error=参数有误!");
        }

        // return Redirect::to('locations/'.Input::get('location_id'));
        return Redirect::to("locations/{$location_id}?success=请求已提交，等待审核中");
    }


    public function destroy($id)
    {
        Locations::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
