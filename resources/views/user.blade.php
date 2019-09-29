@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welome User</div>

                <div class="card-body">
                    You are Logged in Successfully !
                    <a href="{{url(route('edit', auth()->id()))}}" class="btn btn-primary float-right">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
