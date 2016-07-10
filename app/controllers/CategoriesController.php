<?php

class CategoriesController extends BaseController {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('admin', ['except' => ['show']]);

        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
    }


    public function index()
    {
        $data = ['categories' => Categories::notDeleted()->get()];

        return View::make('cms.categories.index', $data);
    }


    public function show($id)
    {
        $category = Categories::findOrFail($id);

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

        $articles = News::whereIn('subcategory_id', $subcategory_ids)->notDeleted()->orderBy('date', 'desc')->skip($offset)->take(self::PER_PAGE)->get();

        $articles_count = News::whereIn('subcategory_id', $subcategory_ids)->notDeleted()->count();

        $total_pages = ceil($articles_count / self::PER_PAGE);

        $start_index = $offset + 1;
        $end_index   = $offset + count($articles);

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);
        $next_page     = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $data = [
            'category'      => $category, 
            'subcategories' => $subcategories, 
            'articles'      => $articles,
            'total_pages'   => $total_pages,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

        return View::make('pages.categories', $data);
    }


    public function create()
    {
        return View::make('cms.categories.create');
    }


    public function store()
    {
        try 
        {
            Categories::create([
                'name' => Input::get('name'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Categories] '.$e->getMessage());

            return Redirect::to("cms/categories/create?error=参数有误!");
        }
  
        return Redirect::to("cms/categories/create?success=创建成功");
    }


    public function edit($id)
    {
        $category = Categories::find($id);

        $data = ['category' => $category];

        return View::make('cms.categories.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Categories::where('id', $id)->update([
                'name' => Input::get('name'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Categories] '.$e->getMessage());

            return Redirect::to("cms/categories/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/categories/{$id}/edit?success=创建成功");
    }


    public function destroy($id)
    {
        Categories::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
