<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
     
    public function index(){

        // $search = request()->query('search');

        // if($search){
        //     $posts =Post::where('title', 'like', "%{$search}%")->simplePaginate();    
        // }else{
        //     $posts =Post::simplePaginate(2);
        // }
       
        return view('welcome')
        ->with('tags',Tag::all())
        ->with('categories', Category::all())
        ->with('posts', Post::searched()->simplePaginate(3));
    }
}
