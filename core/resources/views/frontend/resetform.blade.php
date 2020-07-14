@extends('frontend.loginRegisterlayout')

@section('resetform')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card" style="width: 18rem">
            <div class="card-header bg-info">
                <h3 class="text-light">Reset Password</h3>
            </div>
            <div class="card-body">
                
            <form action="{{route('reset_form')}}" method="POST">
              @csrf
                  <div class="form-group">
                      <input type="password" name="password" placeholder="Your Password" class="form-control">
                  </div>

                <input type="hidden" value="{{request('token')}}" name="token">
                  @if($errors->has('password'))
                <p class="alert alert-danger">{{$errors->first('password')}}</p>
                @endif
                  <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Your Password confirmation" class="form-control">
                </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-info"> 
                  </div>
              </form>
            <span>Go Back To login <a href="{{route('login')}}">Click Here</a></span>
            </div>
          </div>
    </div>
</div>

@endsection