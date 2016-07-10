<?php

class FriendlyController extends BaseController {

    const PER_PAGE = 20;

    private $link;

    public function __construct()
    {
        $this->beforeFilter('worker');
        
        // $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
        
        $link = ltrim(Input::get('link'), 'http://');

        $this->link = 'http://'.$link;
    }


    public function indexFriendly()
    {
        $data = ['sites' => Friendly::isFriendly()->notDeleted()->get()];

        return View::make('cms.related.index_friendly', $data);
    }


    public function indexEducation()
    {
        $data = ['sites' => Friendly::isEducation()->notDeleted()->get()];

        return View::make('cms.related.index_education', $data);
    }


    public function createFriendly()
    {
        return View::make('cms.related.create_friendly');
    }

    public function createEducation()
    {
        return View::make('cms.related.create_education');
    }

    public function storeFriendly()
    {
        try 
        {
            Friendly::create([
                'name' => Input::get('name'),
                'link' => $this->link,
                'type' => 'friendly',
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Friendly] '.$e->getMessage());

            return Redirect::to("cms/friendly_sites/create?error=参数有误!");
        }
  
        return Redirect::to("cms/friendly_sites/create?success=创建成功");
    }


    public function storeEducation()
    {
        try 
        {
            Friendly::create([
                'name' => Input::get('name'),
                'link' => $this->link,
                'type' => 'education',
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create education] '.$e->getMessage());

            return Redirect::to("cms/education_department/create?error=参数有误!");
        }
  
        return Redirect::to("cms/education_department/create?success=创建成功");
    }

    public function editFriendly($id)
    {
        $site = Friendly::find($id);

        $data = ['site' => $site];

        return View::make('cms.related.edit_friendly', $data);
    }

    public function editEducation($id)
    {
        $site = Friendly::find($id);

        $data = ['site' => $site];

        return View::make('cms.related.edit_education', $data);
    }

    public function updateFriendly($id)
    {
        try 
        {
            Friendly::where('id', $id)->update([
                'name' => Input::get('name'),
                'link' => $this->link,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Friendly] '.$e->getMessage());

            return Redirect::to("cms/friendly_sites/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/friendly_sites/{$id}/edit?success=创建成功");
    }

    public function updateEducation($id)
    {
        try 
        {
            Friendly::where('id', $id)->update([
                'name' => Input::get('name'),
                'link' => $this->link,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit education] '.$e->getMessage());

            return Redirect::to("cms/education_department/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/education_department/{$id}/edit?success=创建成功");
    }


    public function deleteFriendly($id)
    {
        Friendly::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }

    public function deleteEducation($id)
    {
        Friendly::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
