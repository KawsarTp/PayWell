@extends('frontend.loginRegisterlayout')

@section('loginPage')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-center text-light">Login Form</h4>
                </div>
                @if(session()->has('error'))
                <p class="alert alert-danger">{{session('error')}}</p>
                @endif
                @if(session()->has('invalidurl'))
                    <p class="alert alert-danger">{{session('invalidurl')}}</p>
                @endif
                @if(session()->has('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                <div class="card-body">
                <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="username" name="username" class="form-control">
                        </div>

                        @if($errors->has('username'))
                            <p class="alert alert-danger">{{$errors->first('username')}}</p>
                        @endif

                    



                        
                        <div class="form-group">
                            <input type="password" placeholder="password" name="password" class="form-control">
                        </div>
                        
                        @if($errors->has('password'))
                            <p class="alert alert-danger">{{$errors->first('password')}}</p>
                        @endif
                        <div class="form-group">
                            <input type="submit"  class="form-control btn btn-info" value="Login">
                        </div>
                    </form>
                <span class="float-right">Forgot Your Password? <a href="{{route('reset')}}">Reset Password</a></span>
                If you are not Registered- <a href="{{route('register')}}">Register Here</a>
                </div>
            </div>
        </div>
        
        
    </div>
</div>

@endsection