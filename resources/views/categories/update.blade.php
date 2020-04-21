@extends('layouts.app')
@section('content')
 <div class="card card-default">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route( 'categories.update', $category->id) }}" method="PUT">
    @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Category Name" value={{$category->name}}>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Add categorie</a>
        </div>
    </form>
    </div>
 </div>
@endsection