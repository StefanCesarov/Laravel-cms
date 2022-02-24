@extends('layouts.app')

@section('content')
    
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">
                  
                  <form action="{{ route('users.update')}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" cols="20" rows="10" class="form-control">{{ auth()->user()->about }}</textarea>
                    </div>   
                    
                    <div class="form-group">
                        <label for="img">Insert image</label>
                        <input type="file" class="form-control mb-2" name="img" id="img" >
                    </div>

                    <div class="form-gorup">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                  </form>
                </div>
            </div>
        </div>
  @endsection