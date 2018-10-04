<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function page(){
        return $this->belongsTo(Page::class);
    
    }
    
    public function pages(){
        return $this->hasMany(Page::class);
    
    }
    
    public function scopeNotdeleted($query){
        return $query->where('deleted', 0);
    }
    
    public function scopeActive($query){
        return $query->where('active', 0);
    }
    
    public function scopeFirstlevel($query){
        return $query->where('page_id', 0);
    }
    
    public function scopeForpage($query, $pageId){
        return $query->where('page_id', $pageId);
    }
    
    public function scopeExcludeme($query, $pageId){
        return $query->where('id', '!=', $pageId);
    }
    
    public static function getLastPosition($pageId){
        $lastPage = Page::where('page_id', $pageId)
                ->notDeleted()
                ->orderBy('priority', 'DESC')
                ->first();
        
        if($lastPage){
            $lastPosition = $lastPage->priority; 
            return $lastPosition + 1;
        } else {
            $lastPosition = -1;
            return $lastPosition + 1;
        }           
    }
    
    public static function getPagesForFrontend($type, $pageId){
        $pages = Page::where($type, 1)
                ->forpage($pageId)
                ->active()
                ->notdeleted()
                ->orderBy('priority', 'ASC')
                ->get();
        
        return $pages;

    }
    
    public function pageUrl(){
        return route('pages-preview', [
            'id' => $this->id,
            'slug' => str_slug($this->title)
        ]);
    }
    
    public function getImage($dimension = 'xl'){
        
        $image = $this->image;
        
        if(!in_array($dimension, ['xl', 'm', 's'])){
            $dimension = 'xl';
        }
        
        // 'kursevi-pro-stipendija.jpg'
        // 'kursevi-pro-stipendija-m.jpg'
        
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $image = str_replace("." . $extension, "", $image);
        $image = $image . '-' . $dimension . '.' . $extension;
        
        return $image;
        
    }
    
}
