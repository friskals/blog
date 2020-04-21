<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage; 
use App\Category;
use App\Tag ;
use App\User;

class Post extends Model
{   
    use SoftDeletes;
    protected $fillable =[
        'title',
        'description',
        'content',
        'image',
        'published_at',
        'category_id',
        'user_id'
    ];
    /**
     * told the laravel if published_at as dates
     */
    protected $dates =[
        'published_at'
    ];
    /**
     * Delete post
     * @return void 
     */

    public function deleteImage(){
        Storage::delete($this->image);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    /**
     * mengembalikan id tag yang dimiliki oleh post. Hasil pemrosesan saat create adalah
     * array dalam array jadi arraynya itu cuman diambil idnya(casenya elemen arraynya banyak)
     * 
     * @return bool
     */
    public function hasTag($TagId){
        return in_array($TagId, $this->tags->pluck('id')->toArray());
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
                         
    public function scopeSearched($query){
        $search = request()->query('search');
        
        if(!$search){
            return $query->published();
        }
        return $query->published()->where('title', 'like', "%{$search}%");

    }
    /**
     * Only get the published post from database
     */

    public function scopePublished($query){
        return $query->where('published_at','<=', now());
    }
   
}
