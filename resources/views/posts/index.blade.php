@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end">
        <a href=" {{ route('posts.create') }} " class="btn btn-success form-group">Add Post</a>
</div>
<div class="card-default">
        <div class="card-header">Post</div>
        <div class="card-body">
        @if($posts->count() > 0)
                <table class="table">
                        <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Action</th>
                        <th></th>
                        </thead>       
                <tbody>
                @foreach ($posts as $post)
                <tr>
                        <td> <img src="/storage/{{$post->image}}" width="120px" height="60px"> </td>  
                        <td>{{ $post->title}}</td>
                        <td><a href=" {{ route('categories.edit', $post->category->id)}} "> {{ $post->category->name}}</a></td>
                @if($post->trashed())
                <td>
                <form action=" {{ route('restore-posts',$post->id)}} " method="POST"> 
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm">Restore</button> 
               </form>
                </td>
                @else                
                <td> <a href=" {{ route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a></td>
                @endif
                <td>
                <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                @csrf
                @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                        {{$post->trashed()?'Delete':'Trash'}}
                        </button>
                </form>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
        @else
                <h4 class="text-center">No Post Yet</h4>
        @endif
        </div>
</div>
@endsection