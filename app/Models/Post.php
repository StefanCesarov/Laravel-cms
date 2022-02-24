<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['published_at'];
    protected $fillable = ['name', 'description', 'content', 'img', 'published_at', 'category_id', 'user_id' ];

    //Deletes file from storage
    public function deleteFromStorage()
    {
        Storage::delete($this->img);
    }

    //relation with Category model    
    public function category ()
    {

        return $this->belongsTo(Category::class);
    }

    public function tags ()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished ($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if($search){
            return $query->published()->where('name', 'LIKE', "%{$search}%");
        }else
        {
            return $query->published();
        }
       
    }
}