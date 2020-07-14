@extends('frontend.layoutdashboard')

@section('content')

@include('frontend.navbar')

@include('frontend.errors')
<div class="container mt-5">
  <div class="row">

    <div class="col-md-3">
      <div class="card bg-primary">
        <div class="card-body text-center text-light">
          <img src="https://img.icons8.com/fluent/96/000000/money.png"/>
          <p class="font-weight-bold"> Wallet : {{auth()->user()->balance}} BDT</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-secondary pb-2">
        <div class="card-body text-center text-light">
          <img src="https://img.icons8.com/dusk/64/000000/change-user-male.png"/>
          <p class="font-weight-bolder pt-4">My reffered User : {{auth()->user()->reffer->count()}}</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-dark">
        <div class="card-body text-center text-light">
          <img src="https://img.icons8.com/nolan/96/split-transaction.png"/>
          <p class="font-weight-bolder pt-1">Total Transaction: {{count($transfermoney)}}</p>
        </div>
      </div>
    </div>


    <div class="col-md-3">
      <div class="card bg-info">
        <div class="card-body text-center text-light">
          <img src="https://img.icons8.com/color/96/000000/admin-settings-male.png"/>
          <a href="" class="font-weight-bolder pt-1 d-block text-light p-2">My Profile</a>
        </div>
      </div>
    </div>

  </div>
</div>


{{-- Money Send Option --}}
  <div class="container">
      <div class="row mt-5">

        <div class="col-md-3">
        
            <div class="card">
              <div class="card-header text-center">
                <img src="https://img.icons8.com/color/48/000000/invite.png"/>
                <p class="font-weight-bold text-muted">INVITE FRIENDS TO GET EXTRA</p>
                <div class="w-100">
              
              </div>
              </div>
      
            <div class="card-body text-center">
              <img src="https://img.icons8.com/color/48/000000/group-background-selected.png"/>
              <p>Invite Friends and get extra 3% comission on Their Transaction and get 2% Sign Up Bonus</p>
              <a href="" class="btn btn-info" data-target="#myModal" data-toggle="modal">INVITE FRIEND</a>
          </div>
            </div>
      </div>




        <div class="col-md-9">
          <div class="card card-cascade wider reverse mt-3">

            <!-- Card image -->
            <div class="card-header text-center">
              <img src="https://img.icons8.com/color/96/000000/exchange.png"/>
              <h1 class="display-4 font-weight-bolder">Transfer Money</h1>
            </div>
          
            <!-- Card content -->
            <div class="card-body card-body-cascade text-center p-5">
          
             
              <form action="{{route('transaction')}}" class="form-inline" method="POST">
                      @csrf
                      <div class="form-group mr-4 ml-5">
                          <input type="text" class="form-control" name="username" placeholder="Receiver Username">
                      </div>
                      <div class="form-group mr-4">
                          <input type="text" class="form-control" name="money" placeholder="Transfer Amount">
                      </div>
              
                      <div class="form-group">
                          <input type="submit" class="btn btn-danger form-control" value="Transfer Amount" id="myBtn">
                      </div>
              
                  </form>
              
                  
          
            </div>
          
          </div>
        </div>
        <!-- Card -->

<!-- Card -->
      </div>
  </div>

  <div class="container my-5">

<div class="row">

  <div class="col-md-3">
    <div class="card">
      <div class="card-header bg-danger">
        <p class="text-light text-center pt-2">Reffer User List</p>
      </div>
      <div class="card-body">
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Username</th>

                  </tr>
        </thead>
            <tbody>
                @php($i = 1)
                @foreach($reffer_list as $reffer)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$reffer->username}}</td>
                  </tr>
                  <tr>
                      @endforeach
        </tbody>
                </table>
      </div>
    </div>
  </div>



  <div class="col-md-9 mx-auto">
    <div class="card">
        <div class="card-header bg-dark ">
            <h3 class="text-center text-light">Transaction Log</h3>
        </div>

        <div class="card-body">
          
              <table class="table">
                  <tr>
                     <th>Serial</th>
                     <th>Trax. Id</th>
                     <th>Amount</th>
                     <th>Charge</th>
                     <th>After Balance</th>
                     <th>Status</th>
                     <th>Send Time</th>
                     <th>Trnx. Type</th>
                  </tr>
                  @php($i = 1)
                  @foreach($transfermoney as $log)
                  <tr>
                      <td>{{$i++}}</td>
                      <td>{{$log->transaction_id}}</td>
                      <td>{{$log->amount}}</td>
                      <td>{{$log->charge}}</td>
                      <td>{{$log->balance}}</td>
                      <td>{{$log->status}}</td>
                      <td>{{$log->created_at->diffForHumans()}}</td>
                      <td class="{{$log->charge == 0 ? 'text-success':'text-danger '}} font-weight-bolder">{{$log->charge == 0 ? 'Credited' : 'debited' }}</td>

                  </tr>
                  @endforeach
              </table>
              {{ $transfermoney->links()}}
        </div>
    </div>
</div>



</div>
  </div>






  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-light">Reciever Email</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-light">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           
        <form action="{{route('reffer_email')}}" method="POST">
              @csrf
              <div class="form-group">
                  <input type="email" name="email" placeholder="Email" class="form-control">
              </div>
              
              <input type="submit" class="btn btn-info" value="Send Email">
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>

@endsection
