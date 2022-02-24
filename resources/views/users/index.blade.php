@extends('layouts.app')
@section('content')


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @if($users->count()>0)
                    <table class="table">
                        <thead>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                                    
                            <th>
                        
                            </th>
                        
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        
                        <tr>
                            <td>
                                <img width="80px" height="80px" style="border-radius: 50%" src="{{ asset('/storage/'.$user->img) }}" alt="" ></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            
                            @if(!$user->isadmin())
                            <td> 
                                <form action="{{ route('users.makeAdministrator', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm" style="color:#FFFFFF">Make administrator</a>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center">
                        <h3 class="text-center">No users yet!</h3>
                    </div>
                    @endif
                </div>
            </div>

       

        </div>

@endsection
