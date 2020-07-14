@extends('admin.layout')

@section('loginpage')
        <div class="card mt-5">
            <div class="card-header">
                <h3>Admin Login Section</h3>
            </div>
            @if(session()->has('error'))
                <p class="alert alert-danger">{{session('error')}}</p>
            @endif
            <div class="card-body">
            <form action="{{route('admin.login')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>


                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>


                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-danger">
                    </div>


                </form>
            </div>
        </div>
@endsection