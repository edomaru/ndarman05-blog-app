<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    protected $fillable = ['category_id'];
    protected $dates = ['published_at'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute($value){

        $imageUrl = "";

        if(!is_null($this->image)){
            $imagePath = public_path() . "/img/" . $this->image;
            if(file_exists($imagePath)) $imageUrl = asset("img/" . $this->image);
        }

        return $imageUrl;
    }

    public function getDateAttribute($value){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute($value){
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    public function getExcerptHtmlAttribute(){
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL; 
    }

    public function scopeLatestFirst($query){
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePublished($query){
        return $query->where("published_at", "<=", Carbon::now());
    }
}
 