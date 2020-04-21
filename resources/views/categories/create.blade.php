@extends('layouts.app')
@section('content')
 <div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? 'Edit Category':'Create Category' }}
    </div>
    <div class="card-body">
    @include('partial.errors')
    <form action="{{ isset($category) ? route( 'categories.update',$category->id) : route( 'categories.store') }}" method="POST">
    @csrf
    <!- Tell the laravel to choose which one is used method-->
    @if(isset($category))
        @method('PUT')
    @endif
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Category Name"
            value="{{ isset($category) ? $category->name : ' '}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">{{isset($category) ? 'Edit categorie' : 
            'Add categorie'}}</a>
        </div>
    </form>
    </div>
 </div>
@endsection