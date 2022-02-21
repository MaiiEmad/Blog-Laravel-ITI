@extends('layouts.app')
@section('title') Empty Statement @endsection
@section('content')
    <div class="text-center mt-5 mb-4">
        <a href="{{route('posts.create')}}" class="btn btn-success ">Create Post</a>
    </div>
@endsection

