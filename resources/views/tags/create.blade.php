@extends('layouts.app')
@section('content')
 <div class="card card-default">
    <div class="card-header">
        {{ isset($tag) ? 'Edit tag':'Create tag' }}
    </div>
    <div class="card-body">
    @include('partial.errors')
  
    <form action="{{ isset($tag) ? route( 'tags.update',$tag->id) : route( 'tags.store') }}" method="POST">
    @csrf
    <!- Tell the laravel to choose which one is used method-->
    @if(isset($tag))
        @method('PUT')
    @endif
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Tag Name"
            value=" {{ isset($tag) ? $tag->name:' ' }} ">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">{{isset($tag) ? 'Edit categorie' : 
            'Add Tag'}}</a>
        </div>
    </form>
    </div>
 </div>
@endsection