@extends('admin.dashboardlayout')

@section('content')

@include('admin.navbar')

@if(session()->has('error'))
  <p class="alert alert-danger">{{session('error')}}</p>
@endif

    <div class="container mt-5">
      <a href="{{route('admin.givecomission')}}" class="btn btn-primary">Give Comission To all User</a>
        <div class="row justify-content-center">
        
            {{-- Refferal Commision --}}
            <div class="card mx-5">
                <div class="card-header">
                    <h3>Set All Site Setting</h3>
                </div>

                <div class="card-body">
                  @if(session()->has('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                  @endif
                <form action="{{route('admin.setting')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Refferal Comission</span>
                              </div>
                            <input type="text" class="form-control" placeholder="Refferal Comission" name="comission" value="{{$all_setting->comission}}">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                        @if($errors->has('comission'))
                           @if(session()->has('invalidurl'))
                    <p class="alert alert-danger">{{session('invalidurl')}}</p>
                @endif<p class="alert alert-danger">{{$errors->first('comission')}}</p>
                        @endif
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Transaction Bonus</span>
                              </div>
                            <input type="text" class="form-control" placeholder="Set Bonus on trans." name="transbonus" value="{{ $all_setting->trans_bonus}}">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>



                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Site Charge</span>
                              </div>
                        <input type="text" class="form-control" placeholder="Set Site Charge" name="charge" value="{{$all_setting->charge}}">
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Bonus For All</span>
                              </div>
                            <input type="text" class="form-control" placeholder="Bonus For All" name="bonusall" value="{{$all_setting->bonusall}}">
                        </div>


                        

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sign Up Bonus</span>
                          </div>
                        <input type="text" class="form-control" placeholder="Bonus For All" name="signUp" value="{{$all_setting->signup_bonus}}">
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Currency</span>
                        </div>
                      <input type="text" class="form-control" placeholder="Bonus For All" name="currency" value="{{$all_setting->currency}}">
                  </div>



                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Update">
                        </div>
                    </form>
                </div>
            </div>
{{-- End of Refferal Commision --}}


        </div>
    </div>


@endsection