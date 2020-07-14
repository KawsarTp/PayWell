@extends('frontend.loginRegisterlayout')

@section('resetPage')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card" style="width: 18rem">
            <div class="card-header bg-info">
                <h3 class="text-light">Reset Password</h3>
            </div>
            <div class="card-body">
              @if(session()->has('error'))
            <p class="alert alert-danger">{{session('error')}}</p>
            @endif
            @if(session()->has('success'))
            <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <form action="{{route('reset')}}" method="POST">
              @csrf
                  <div class="form-group">
                      <input type="text" name="email" placeholder="Your Email" class="form-control">
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