@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end">
    <a href="{{ route('tags.create')}}" class="btn btn-success my-2">Add Tag</a>
    </div>
     <div class="card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
        @if($tags->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Post Count</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts->count() }}</td>
                        <td><a class="btn btn-danger my-2" onclick="handleDelete({{$tag->id}})">Delete</button></a>
                        <td><a class="btn btn-info my-2" href="{{ route('tags.edit',$tag->id) }}">Update</button></a>
                    </tr>
                @endforeach
            </tbody>
            </table> 
        @else
        <h4 class="text-center">No Tag Yet</h4>
        @endif
           <form action="" id="deleteTagForm" method="POST"> 
           @csrf
           @method('DELETE')
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this Tag?
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
        var form = document.getElementById('deleteTagForm')        
        form.action = '/tags/'+id
        console.log(form)
        $('#deleteModal').modal('show')
    }
    </script>
@endsection