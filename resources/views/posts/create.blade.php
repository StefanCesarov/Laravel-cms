@extends('layouts.app')
@section('content')

        <div class="col-md-8">

            
            <div class="card">
                <div class="card-header">
                    {{isset($post)? 'Edit post' : 'Add post'}}
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method ='POST' enctype="multipart/form-data">
                        @csrf
                        @if(isset($post))
                            @method("PUT")
                        @endif
                        <div class="form-group">
                            <label for="postName">Post name</label>
                            <input type="text" class="form-control mb-2" name="name" id="postName" value="{{isset($post) ?  $post->name : ''}}">
                        </div>

                         <div class="form-group">
                            <label for="postDescription">Post description</label>
                            <Textarea class="form-control mb-2" name="description" id="postDescription" rows="3">{{isset($post) ?  $post->description : ''}}</Textarea>
                        </div>  

                        <div class="form-group">
                            <label for="postContent">Post content</label>

                            <input id="content" type="hidden" name="content" value="{{isset($post) ?  $post->content : ''}}">
                            <trix-editor input="content"></trix-editor> 
                           <!-- <Textarea class="form-control mb-2" name="content" id="postContent" rows="3"></Textarea>-->
                        </div>  
                        @if(isset($post))
                        <div class="form-group">
                            <img src="{{asset('/storage/'.$post->img)}}" alt="no preview" style="width:100%">
                        </div>
                        @endif
                         <div class="form-group">
                            <label for="postImg">Inser image</label>
                            <input type="file" class="form-control mb-2" name="img" id="postImg" >
                        </div> 

                        <div class="form-group">
                            <label for="postPublishedat">Published at</label>
                            <input type="text" class="form-control mb-2" name="published_at" id="postPublishedat" value="{{isset($post) ?  $post->published_at : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control mb-2" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @if(isset($post))
                                            @if ($category->id == $post->category_id)
                                                selected
                                            @endif
                                        @endif
                                        >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($tags->count()>0)
                        <div class="form-group">
                            <label for="tag_id">Tags</label>
                            <select name="tag_id[]" id="tag_id" class="form-control mb-2 js-example-basic-multiple"  multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" 
                                        @if(isset($post))
                                            @if ($post->hasTag($tag->id))
                                                selected
                                            @endif
                                        @endif
                                        >{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                       @endif

                        <div class="form-group">    
                            <button type="submit" name="store" class="btn btn-success">
                                {{isset($post) ? 'Update' : 'Save'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#postPublishedat');
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            
        });
    </script>
@endsection