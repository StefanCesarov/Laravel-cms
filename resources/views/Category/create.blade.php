@extends('layouts.app')
@section('content')

        <div class="col-md-8">

            
            <div class="card">
                <div class="card-header">
                    {{isset($category)? 'Edit category' : 'Add category'}}
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method ='POST'>
                        @csrf
                        @if(isset($category))
                            @method("PUT")
                        @endif
                        <div class="form-group">
                            <label for="CategoyName">Category name</label>
                            <input type="text" class="form-control mb-2" name="name" id="CategoyName" value="{{isset($category) ?  $category->name : ''}}">
                        </div>
                        <div class="form-group">    
                            <button type="submit" name="store" class="btn btn-success">
                                {{isset($category) ? 'Update' : 'Save'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


@endsection