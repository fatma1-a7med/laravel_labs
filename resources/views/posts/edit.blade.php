@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Post</h2>
        <form action="/posts/{{ $post['id'] }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $post['name'] }}" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3" required>{{ $post['body'] }}</textarea>
            </div>
           
            <div class="mb-3">
                <label for="user_id" class="form-label">user_id</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $post['user_id'] }}" disabled>
            </div>
            <div class="mb-3">
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </div>
@endsection