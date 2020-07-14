@extends('frontend.loginRegisterlayout')

@section('registerPage')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="text-center text-light">Registration Form</h4>
                    </div>

                    <div class="card-body">
                        @if(session()->has('error'))
                            <p class="alert alert-danger">{{session('error')}}</p>
                        @endif
                    <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="username" name="username" class="form-control">
                            </div>

                            @if($errors->has('username'))
                                <p class="alert alert-danger">{{$errors->first('username')}}</p>
                            @endif

                        

                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control">
                            </div>

                            @if($errors->has('email'))
                                <p class="alert alert-danger">{{$errors->first('email')}}</p>
                            @endif

                            <div class="form-group">
                                <input type="text" placeholder="Reffer Id(Optional)" name="reffer" class="form-control" value="{{$username}}">
                            </div>


                            
                            <div class="form-group">
                                <input type="password" placeholder="password" name="password" class="form-control">
                            </div>
                            
                            @if($errors->has('password'))
                                <p class="alert alert-danger">{{$errors->first('password')}}</p>
                            @endif
                            

                            <div class="form-group">
                                <input type="password" placeholder="confirm Password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit"  class="form-control btn btn-info" value="Register">
                            </div>
                        </form>
                        If you already Registered- <a href="{{route('login')}}">Login Here</a>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

@endsection