<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Post extends Model
{

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

    public function getDateAttribute(){
        return $date = $this->created_at->diffForHumans();
    }

    public function scopeLatestFirst(){
        return $this->orderBy('created_at', 'asc');
    }
}
