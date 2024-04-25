@extends('layouts.app')
@section('content')

<div class="container">
  
<h2>Add New Post</h2><br><br>
<form method="POST" action="/posts" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
            </div>
          
            <div class="mb-3">
                <label for="user_id" class="form-label">user_id</label>
                <input type="text" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="mb-3">
                <input type="file" name="image"> 
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
       
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