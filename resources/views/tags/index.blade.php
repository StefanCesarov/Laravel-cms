@extends('layouts.app')
@section('content')


        <div class="col-md-8">

            
            <div class="d-flex justify-content-end">
                <a class="btn btn-success mb-1" href="{{route('tags.create')}}">Add Tag</a>
            </div>
            
            
            <div class="card">
                <div class="card-header">tags</div>

                <div class="card-body">
                @if($tags->count()>0)
                    <table class="table">
                        <thead>
                        
                            <th>Name</th>
                            <th>No of Posts</th>
                            <th>Edit/Delete</th>
                        
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)

                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>{{ $tag->posts->count() }}</td>
                            <td> 
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm" style="color:#FFFFFF">Edit</a>
                                <button type="button" name="delete" class="btn btn-danger btn-sm mr-2" style="color:#FFFFFF" onclick="handleDelete({{$tag->id}})">Delete</button>
                                
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center">
                        <h3 class="text-center">No tags yet!</h3>
                    </div>
                    @endif
                </div>
            </div>

            <!-- modal-->
            <form action="" method="POST" id="deleteTag">
                @csrf
                @method('DELETE')
                <div class="modal" tabindex="-1" id="modalDelete" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <b>Are you soure want to delete this tag?</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

@endsection
@section('script')
<script>

function handleDelete(id){

    var form = document.getElementById("deleteTag");
    form.action = '/tags/' + id;
    
    $('#modalDelete').modal('show');
} 

</script>
@endsection