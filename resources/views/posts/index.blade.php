@extends('layouts.app')
@section('content')


        <div class="col-md-8">

            
            <div class="d-flex justify-content-end">
                <a class="btn btn-success mb-1" href="{{route('posts.create')}}">Add Post</a>
            </div>
            
            
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    @if($posts->count()>0)
                    <table class="table">
                        <thead>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            
                            <th></th>
                            
                            <th></th>
                        
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        
                        <tr>
                            <td><img src="{{ asset('/storage/'.$post->img)}}" alt="img" width="100px" height="80px"></td>
                            <td>{{$post->name}}</td>
                            <td>{{ isset($post->category['name']) ? $post->category['name'] : ''}}</td>
                            @if(!$post->trashed())
                            <td> 
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm" style="color:#FFFFFF">Edit</a>
                                
                            </td>
                            @else
                            <td> 
                                <form action="{{ route('restorePost', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm" style="color:#FFFFFF">Restore</button>
                                
                                </form>
                                
                            </td>
                            @endif
                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="subbmit" name="delete" class="btn btn-danger btn-sm mr-2" style="color:#FFFFFF">
                                    {{$post->trashed()? 'Delete' : 'Trash'}}
                                    </button>
                                  
                                </form>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center">
                        <h3 class="text-center">No posts yet!</h3>
                    </div>
                    @endif
                </div>
            </div>

       

        </div>

@endsection
