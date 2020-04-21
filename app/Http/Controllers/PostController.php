<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\postss\CreatePostsRequest;
use App\Http\Requests\postss\UpdatePostRequest;
use App\Category;
use App\Tag;


class PostController extends Controller
{
    public function __construct(){
        
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('posts.index') -> with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    { 
        $image = $request->image->store('posts');

        $post =Post::create([
            'title'=>$request['title'],
            'description' => $request['description'],
            'content' => $request['content'],
            'image' =>$image,
            'published_at' => $request['published_at'],
            'category_id'=>$request['category'],
            'user_id' => auth()->user()->id
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        session()->flash('success', 'Post created successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','content','description','published_at']);

        if($request->hasFile('image')){

            $image = $request->image->store('posts'); 
            
            $post->deleteImage();
            
            $data['image'] =$image;
        }

        $post->update($data);
        
        /**
         * sync() untuk menyinkronkan updateny kalo belum tag yang dipilih
         * sebelumnya belum diattach maka jadi diattach begitu juga sebaliknya
         */
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        session()->flash('success', 'Post updated successfully');
        
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if($post->trashed()){
           
            $post->deleteImage();
           
            $post->forceDelete();
        
        }else{

            $post->delete();//softDelete
        }
        session()->flash('success', 'Post deleted successfully');
        return redirect(route('posts.index'));
 
    }
    /**
     * Show all the list of trased posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
          /**
         * withTrashed return all record trashed or not
         * onlyTrashed return all trashed record
         */

        $trashed = Post::onlyTrashed()->get();        
        return view('posts.index')->with('posts',$trashed);
        //return view('posts.index')->with('posts',$trashed);
    }
    public function restore($id){
         
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post restored successfully');
        return redirect()->back();
    }
}
