@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit
                    @if(auth()->user()->isAdmin == 1)
                        Admin
                    @else
                        User
                    @endif
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update', $model->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$model->name}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{$model->email}}">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        @if(auth()->user()->isAdmin == 1)
                            <a href="/admin" class="btn btn-secondary float-right">Cancel</a>
                        @else
                            <a href="/user" class="btn btn-secondary float-right">Cancel</a>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
