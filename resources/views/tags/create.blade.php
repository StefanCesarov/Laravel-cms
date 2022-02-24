@extends('layouts.app')
@section('content')

        <div class="col-md-8">

            
            <div class="card">
                <div class="card-header">
                    {{isset($tag)? 'Edit tag' : 'Add tag'}}
                </div>
                <div class="card-body">
                 @include('partials.errors')
                    <form action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" method ='POST'>
                        @csrf
                        @if(isset($tag))
                            @method("PUT")
                        @endif
                        <div class="form-group">
                            <label for="TagName">Tag name</label>
                            <input type="text" class="form-control mb-2" name="name" id="TagName" value="{{isset($tag) ?  $tag->name : ''}}">
                        </div>
                        <div class="form-group">    
                            <button type="submit" name="store" class="btn btn-success">
                                {{isset($tag) ? 'Update' : 'Save'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


@endsection