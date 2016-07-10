<?php

class NewsController extends BaseController {

    const PER_PAGE = 20;

    public $current_worker_id;

    public function __construct()
    {
        $this->beforeFilter('worker', ['except' => ['show']]);

        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   

        $this->current_worker_id = Session::get('user_name');
    }


    public function index()
    {
        $sql = News::join('subcategories', 'news.subcategory_id', '=', 'subcategories.id')->join('categories', 'news.category_id', '=', 'categories.id')->select('news.*', 'subcategories.name as subcategory_name', 'categories.name as category_name')->where('news.status', 'active');

        // Teacher only can see their own articles :
        if (Session::get('user_role') !== 'admin') $sql = $sql->where('news.user_id', Session::get('user_id'));

        $news = $sql->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $news->getLastPage();

        $total_count = $news->getTotal();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $news->getFrom();

        $end_index = $news->getTo();

        $data = [
            'news'          => $news,
            'total_pages'   => $total_pages,
            'total_count'   => $total_count,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

        return View::make('cms.news.index', $data); // return View('pages.about');
    }


    public function show($id)
    {
        $record = News::findOrFail($id);

        $subcategory = Subcategories::findOrFail($record->subcategory_id);

        $category = Categories::findOrFail($subcategory->category_id);

        // Training history:
        $training_history = null;

        if ($record->training_id && $this->current_worker_id)
        {
            $training_history = TrainingsAttendees::where('training_id', $record->training_id)->where('worker_id', $this->current_worker_id)->first();
        }

        $data = [
            'record'            => $record, 
            'subcategory'       => $subcategory, 
            'category'          => $category, 
            'training_history'  => $training_history, 
            'current_worker_id' => $this->current_worker_id
            ];

        return View::make('pages.news', $data); // return View('pages.about');
    }


    public function create()
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $trainings = Trainings::notDeleted()->notOver()->get();

        $data = ['subcategories' => $subcategories, 'trainings' => $trainings];

        return View::make('cms.news.create', $data);
    }


    public function store()
    {
        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            $subcategory = Subcategories::find(Input::get('subcategory_id'));

            News::create([
                'user_id'        => Input::get('user_id'),
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'category_id'    => $subcategory->category_id,
                'subcategory_id' => Input::get('subcategory_id'),
                'training_id'    => Input::get('training_id'),
                'document'       => $upload_document,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create News] '.$e->getMessage());

            return Redirect::to("cms/news/create?error=参数有误!");
        }

        return Redirect::to("cms/news/create?success=创建成功");
    }


    public function edit($id)
    {
        $article = News::find($id);

        if ($article->user_id != Session::get('user_id')) return Redirect::to("/logout");

        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $trainings = Trainings::notDeleted()->notOver()->get();

        $data = ['subcategories' => $subcategories, 'article' => $article, 'trainings' => $trainings];

        return View::make('cms.news.edit', $data);
    }

    public function update($id)
    {
        $article = News::find($id);

        if ($article->user_id != Session::get('user_id')) return Redirect::to("/logout");

        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            $subcategory = Subcategories::find(Input::get('subcategory_id'));

            News::where('id', $id)->update([
                'user_id'        => Input::get('user_id'),
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'category_id'    => $subcategory->category_id,
                'subcategory_id' => Input::get('subcategory_id'),
                'training_id'    => Input::get('training_id'),
                'document'       => $upload_document,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Update News] '.$e->getMessage());

            return Redirect::to("cms/news/{$id}/edit?success=参数有误!");
        }

        return Redirect::to("cms/news/{$id}/edit?success=编辑成功");
    }


    public function destroy($id)
    {
        News::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
