<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    
    public function index($page = 0){
        //dd($page);
        if(!isset($page) || empty($page)){
            $pageId = 0;
        } else {
            $pageId = $page;
            $page = Page::findOrFail($pageId);
        }
        
        //dd($pageId);
        
        // $data are all pages for $pageId
        $data = Page::notdeleted()->forpage($pageId)->orderBy('priority', 'ASC')->get();
        
        return view('admin.pages.index', compact('data', 'page'));
        
    }
    
    public function create(){
        
        $pageIdsPossibleValues = [ 0 ];
        $mainPages = Page::notdeleted()->firstlevel()->get();
        if(count($mainPages) > 0){
            foreach ($mainPages as $value) {
                array_push($pageIdsPossibleValues, $value->id);
            }
        }
        
        
        $pageIdsPossibleValuesString = implode(',', $pageIdsPossibleValues);
        
        if(request()->isMethod('post')){
            $this->validate(request(), [
                'page_id' => "required|integer|in:$pageIdsPossibleValuesString", // 0,1,2
                'title' => 'required|string|max:191',
                'description' => 'required|string',
                'content' => 'required|string',
                'image' => 'required|mimes:jpeg,bmp,png',
                'header' => 'required|in:0,1',
                'aside' => 'required|in:0,1',
                'footer' => 'required|in:0,1',
                'contact_form' => 'required|in:0,1',
            ]);
            
            $newRow = new Page();
            $newRow->page_id = request('page_id');
            $newRow->priority = Page::getLastPosition(request('page_id'));
            $newRow->title = request('title');
            $newRow->description = request('description');
            $newRow->content = request('content');
            $newRow->header = request('header');
            $newRow->aside = request('aside');
            $newRow->footer = request('footer');
            $newRow->contact_form = request('contact_form');
            $newRow->active = 0;
            $newRow->deleted = 0;
            
            $image = "";
            
            // check image element in request and accept image
            if(request()->hasFile('image')){
                $file = request('image');
//                echo $file->getClientOriginalName();
//                echo $file->getClientOriginalExtension();
                
                $fileName = str_slug($newRow->title, '-');
                $extension = $file->getClientOriginalExtension();
                $fullFileName =  config('app.seo-image-prefix') . $fileName . "." . $extension;
                
                $file->move(public_path('/uploads/pages'), $fullFileName);
                $image = '/uploads/pages/' . $fullFileName;
                
                // intervention
                // create image from original               
                $intervetionImage = Image::make( public_path('/uploads/pages/') . $fullFileName );
                // xl size
                $intervetionImage->resize(547, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameXL =  config('app.seo-image-prefix') . $fileName . "-xl." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameXL );
                
                // m size
                $intervetionImage->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameM =  config('app.seo-image-prefix') . $fileName . "-m." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameM );
                
                // s size
                $intervetionImage->resize(120, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameS =  config('app.seo-image-prefix') . $fileName . "-s." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameS );
                
                //die();
            }
            
            
            $newRow->image = $image;

            $newRow->save();
            
            // set message
            
            session()->flash('message-type', "success");
            session()->flash('message', "Page $newRow->title has been created successfully!!!");
            
            
//            session()->flash('message', [
//                'type' => 'success',
//                'text' => "User $newRow->name has been created successfully!!!"
//            ]);
            
            return redirect( route('pages') );
        }
        
        
        
        return view('admin.pages.create', compact('mainPages'));
    }
    
    public function edit(Page $page){
        
        $pageIdsPossibleValues = [ 0 ];
        $mainPages = Page::notdeleted()->firstlevel()->excludeme($page->id)->get();
        if(count($mainPages) > 0){
            foreach ($mainPages as $value) {
                array_push($pageIdsPossibleValues, $value->id);
            }
        }
        
        
        $pageIdsPossibleValuesString = implode(',', $pageIdsPossibleValues);
        
        if(request()->isMethod('post')){
            $this->validate(request(), [
                'page_id' => "required|integer|in:$pageIdsPossibleValuesString", // 0,1,2
                'title' => 'required|string|max:191',
                'description' => 'required|string',
                'content' => 'required|string',
                'image' => 'nullable|mimes:jpeg,bmp,png',
                'header' => 'required|in:0,1',
                'aside' => 'required|in:0,1',
                'footer' => 'required|in:0,1',
                'contact_form' => 'required|in:0,1',
            ]);
            
            $page->page_id = request('page_id');
            $page->title = request('title');
            $page->description = request('description');
            $page->content = request('content');
            $page->header = request('header');
            $page->aside = request('aside');
            $page->footer = request('footer');
            $page->contact_form = request('contact_form');
            
            $image = $page->image;
            
            // check image element in request and accept image
            if(request()->hasFile('image')){
                $file = request('image');
//                echo $file->getClientOriginalName();
//                echo $file->getClientOriginalExtension();
                
                $fileName = str_slug($page->title, '-');
                $extension = $file->getClientOriginalExtension();
                $fullFileName =  config('app.seo-image-prefix') . $fileName . "." . $extension;
                
                $file->move(public_path('/uploads/pages'), $fullFileName);
                $image = '/uploads/pages/' . $fullFileName;
                
                // intervention
                // create image from original               
                $intervetionImage = Image::make( public_path('/uploads/pages/') . $fullFileName );
                // xl size
                $intervetionImage->resize(547, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameXL =  config('app.seo-image-prefix') . $fileName . "-xl." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameXL );
                
                // m size
                $intervetionImage->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameM =  config('app.seo-image-prefix') . $fileName . "-m." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameM );
                
                // s size
                $intervetionImage->resize(120, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $fullFileNameS =  config('app.seo-image-prefix') . $fileName . "-s." . $extension;
                $intervetionImage->save( public_path('/uploads/pages/') . $fullFileNameS );
                
                //die();
            }
            
            
            $page->image = $image;

            $page->save();
            
            // set message
            
            session()->flash('message-type', "success");
            session()->flash('message', "Page $page->title has been edited successfully!!!");
            
            
//            session()->flash('message', [
//                'type' => 'success',
//                'text' => "User $newRow->name has been created successfully!!!"
//            ]);
            
            if($page->page_id == 0){
                return redirect( route('pages') );
            } else {
                return redirect( route('pages', $page->page_id ) );
            }
            
        }
        
        
        
        return view('admin.pages.edit', compact('mainPages', 'page'));
    }
    
    public function activate(Page $page){
        
        if($page->active == 1){
            $page->active = 0;
            $page->save();
        } else {
            $page->active = 1;
            $page->save();
        }
        
        // set message
        session()->flash('message-type', "success");
        session()->flash('message', "Page $page->title status updated successfully!!!");
            
        
        return redirect( route('pages') );
    }
    
    public function newOrder(){
        if(request()->isMethod('post')){
            // validate ???????
            
            $pageId = request('page_id');
            $newPriority = request('new-priority');
            
            $priorities = explode(",", $newPriority);
            if(count($priorities) > 0){
                $i = 0;
                foreach ($priorities as $id) {
                    $tempPage = Page::findOrFail($id);
                    
                    if($tempPage->page_id == $pageId){
                        $tempPage->priority = $i;
                        $tempPage->save();
                        $i++;
                    }
                }
            }
            //session()->flash('message-type', "success");
            $message = "Pages reordered successfully!!!";
            
        } else{
            //session()->flash('message-type', "danger");
            $message = "Please send post request!!!";
        }
        
        // set message
        //session()->flash('message', $message);
        
        echo "<div class='row'>
                <div class='col-lg-12'>
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        ".$message."
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>";
        
        //return back();
    }
    
    public function delete(Page $page){
        $page->deleted = 1;
        //$page->deleted_by = auth()->user()->id;
        $page->save();
        
        // set message
        session()->flash('message-type', "success");
        session()->flash('message', "Page $page->title deleted successfully!!!");
            
        
        return redirect( route('pages') );
    }
}
