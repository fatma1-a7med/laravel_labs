@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="mt-5">All Posts</h2>
<table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Body</th>
          <th>Comment</th>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['name'] }}</td>
                    <td>{{ $post['body'] }}</td>
                    <td>{{ $post['comment'] }}</td>
                 
                    <td> 
                    <form action="/posts/{{ $post['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
           </td> 

                </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection