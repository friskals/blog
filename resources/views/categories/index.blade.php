@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end">
    <a href="{{ route('categories.create')}}" class="btn btn-success my-2">Add Category</a>
    </div>
     <div class="card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
        @if($categories->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Post Count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count()}}</td>
                        <td><a class="btn btn-danger my-2" onclick="handleDelete({{$category->id}})">Delete</button></a>
                        <td><a class="btn btn-info my-2" href="{{ route('categories.edit',$category->id) }}">Update</button></a>
                    </tr>
                @endforeach
            </tbody>
            </table> 
        @else
        <h4 class="text-center">No Category Yet</h4>
        @endif
           <form action="" id="deleteCategoryForm" method="POST"> 
           @csrf
           @method('DELETE')
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this category?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    </di/v>
                    </div>
                </div>
                </div>
           </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    function handleDelete(id)
    {
        var form = document.getElementById('deleteCategoryForm')        
        form.action = '/categories/'+id
        console.log(form)
        $('#deleteModal').modal('show')
    }
    </script>
@endsection