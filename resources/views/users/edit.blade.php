@extends('layouts.app')

@section('content')
<div class="card">
@include('partial.errors')
                <div class="card-header">My Profil</div>
                <div class="card-body">
                <form action="{{route('users.update-profile')}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" value={{$user->name}}>
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" cols="10" rows="5" class="form-control"> {{$user->about}} </textarea>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                    </div>
                </form>
                </div>
            </div>
@endsection
