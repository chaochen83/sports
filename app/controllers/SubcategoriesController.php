<?php

class SubcategoriesController extends BaseController {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('admin', ['except' => ['show']]);
        
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
    }


    public function index()
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category', 'categories.id as category_id')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $data = ['subcategories' => $subcategories];

        return View::make('cms.subcategories.index', $data);
    }


    public function show($id, $sub_id)
    {
        $current_subcategory = Subcategories::findOrFail($sub_id);

        $category = Categories::findOrFail($id);

        $subcategory = Subcategories::find($sub_id);

        $subcategories = Subcategories::where('category_id', $category->id)->notDeleted()->orderBy('id')->get();

        $subcategory_ids = [];

        foreach ($subcategories as $sub) 
        {
            $subcategory_ids[] = $sub->id;
        }

        //////////////
        // Articles //
        //////////////
        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $offset = ($current_page - 1) * self::PER_PAGE;

        $trainings = Trainings::where('subcategory_id', $sub_id)->notDeleted()->notOver()->orderBy('date', 'desc')->get();

        $articles = News::where('subcategory_id', $sub_id)->notDeleted()->orderBy('date', 'desc')->skip($offset)->take(self::PER_PAGE)->get();

        // Sort:
        $items = [];

        foreach ($trainings as $training) {
            $items[$training->date] = $training;
            $items[$training->date]['type'] = 'training';
        }

        foreach ($articles as $article) {
            $items[$article->date] = $article;
            $items[$article->date]['type'] = 'news';
        }

        krsort($items);

        $records = array_slice($items, $offset, self::PER_PAGE);

        $articles_count = count($items);

        $total_pages = ceil($articles_count / self::PER_PAGE);

        $start_index = $offset + 1;

        $end_index = $start_index + count($articles) - 1;

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $data = [
            'html_title'          => $subcategory->name.'-上海体育学院教师教学发展中心',
            'current_sub_id'      => $sub_id, 
            'current_subcategory' => $current_subcategory, 
            'category'            => $category, 
            'subcategories'       => $subcategories, 
            'records'             => $records,
            'total_pages'         => $total_pages,
            'start_index'         => $start_index,
            'end_index'           => $end_index,
            'current_page'        => $current_page,
            'previous_page'       => $previous_page,
            'next_page'           => $next_page,
            ];

        if ($current_subcategory->types == 1)
        {
            return View::make('pages.single_subcategories', $data);
        }
        elseif ($current_subcategory->types == 2) 
        {
            return Redirect::to('/messages');
        }
        else
        {
            return View::make('pages.subcategories', $data);
        }
    }


    public function create()
    {
        $categories = Categories::distinct('name')->notDeleted()->get();

        $data['categories'] = $categories;

        return View::make('cms.subcategories.create', $data);
    }


    public function store()
    {
        try 
        {
            Subcategories::create([
                'category_id' => Input::get('category_id'),
                'name'        => Input::get('name'),
                'types'       => Input::get('types'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Subcategories] '.$e->getMessage());

            return Redirect::to("cms/subcategories/create?error=参数有误!");
        }
  
        return Redirect::to("cms/subcategories/create?success=创建成功");
    }


    public function edit($id)
    {
        $categories = Categories::distinct('name')->notDeleted()->get();

        $subcategory = Subcategories::find($id);

        $data = [
            'categories'  => $categories,
            'subcategory' => $subcategory,
            ];

        return View::make('cms.subcategories.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Subcategories::where('id', $id)->update([
                'category_id' => Input::get('category_id'),
                'name'        => Input::get('name'),
                'types'       => Input::get('types'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Subcategories] '.$e->getMessage());

            return Redirect::to("cms/subcategories/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/subcategories/{$id}/edit?success=创建成功");
    }


    public function destroy($id)
    {
        Subcategories::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
