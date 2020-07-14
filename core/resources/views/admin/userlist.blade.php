@extends('admin.dashboardlayout')

@section('content')


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header text-center">
                        <h3>All User List</h3>
                       
                        @include('admin.errors')
                    </div>
            
                    <div class="card-body">
                        
                            <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                                <td>Serial</td>
                                <td>Username</td>
                                <td>Email</td>
                                <td>Balance</td>
                                <td>Action</td>
                            </tr>

                            @if(!isset($user_list))
                                <tr>
                                    <td colspan="6"><p class="alert alert-warning">No User</p></td>
                                </tr>
                            @else
                            @php($i=1)
                            @foreach($user_list as $user)
                            <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            
                            <td>{{$user->balance}}</td>
                            <td>
                                <a href="" class="btn btn-info" data-target="#mymodal-{{$user->id}}" data-toggle="modal">Edit User</a>
                            </td>

                            
                            </tr>
                        <div class="modal fade" id="mymodal-{{$user->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Update Balance</h3>
                                        </div>
        
                                        <div class="modal-body">
                                        <form action="{{route('admin.update')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="userid" value="{{$user->id}}">

                                                <div class="form-group">
                                                    <label for="">User Balance</label>
                                                    <input type="text" class="form-control" value="{{$user->balance}}" readonly> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Add Balance</label>
                                                    <input type="text" name="addBalance" placeholder="update Balance" class="form-control" value="0"> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Subtruct Balance</label>
                                                    <input type="text" name="subBalance" placeholder="update Balance" class="form-control" value="0"> 
                                                </div>
        
                                                <div class="form-group">
                                                    <input type="submit" class="form-control btn btn-info" value="Update Balance"> 
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{ $user_list->links() }}
                            @endif
                        </table>
                    </div>


                   
            
                </div>
            </div>
        </div>
    </div>
    

@endsection