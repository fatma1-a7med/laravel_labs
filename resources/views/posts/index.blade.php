@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between my-4">
        <h2>All Posts</h2>
        <a href="/posts/create" class="btn btn-info "> Add new post </a>
    </div>

 
<table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Body</th>
          <th>Image</th>
          <th>User Name</th>
          <th>User email</th>
          <th>Show</th>
          <th>Edit</th>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['name'] }}</td>
                    <td>{{ $post['body'] }}</td>
                    <td><img src="/images/{{ $post->image }}" width="200" height="200"/></td>
                    <td>{{ $post->user->name}}</td>
                    <td>{{ $post->user->email}}</td>
                    <td><a href="{{ route('posts.show',$post['id']) }}" class="btn btn-success">Show</a></td>
                    <td><a href="{{ route('posts.edit',$post['id']) }}"  class="btn btn-info"> Edit </a></td>
                 
                    <td>  
                    <form action="{{ route('posts.destroy',$post['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
           </td> 

                </tr>
        @endforeach
      </tbody>
    </table>
    {{$posts->links('pagination::bootstrap-4')}}
  </div>

  @endsection
