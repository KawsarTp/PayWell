@extends('admin.dashboardlayout')

@section('content')


    <div class="container mt-5">
        <h3 class="font-weight-bolder text-center">{{$id->username."'s"}} All Information</h3>
        <div class="row mt-5">
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="https://img.icons8.com/color/48/000000/money-bag.png"/>
                        <h5 class="card-title py-3">User Balance</h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">{{$id->balance}} BDT</p>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="https://img.icons8.com/color/48/000000/groups.png"/>
                        <h5 class="card-title py-3">User Refferance</h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">Total : {{ $reffer > 0 ? $reffer :'No Reffer'}}</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="https://img.icons8.com/color/48/000000/card-exchange.png"/>
                        <h5 class="card-title py-3">Total Transaction</h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">Total : {{ $id->transactions->count() > 0 ? $id->transactions->count() :'No Transaction'}}</p>
                    </div>
                </div>
            </div>


            
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                    <img src="https://img.icons8.com/fluent/48/000000/money-transfer.png"/>
                        <h5 class="card-title py-3">Total Reffered Comission</h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">Total : {{ $reffredBonus > 0 ? $reffredBonus.' '.'BDT' :'No Transaction'}} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                    <img src="https://img.icons8.com/dusk/48/000000/cash-in-hand.png"/>
                        <h5 class="card-title py-3">Total Get Direct Money </h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">Total : {{ $allMoneyWithoutReffer > 0 ? $allMoneyWithoutReffer.' '.'BDT' :'No Transaction'}}</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                    <img src="https://img.icons8.com/fluent/48/000000/initiate-money-transfer.png"/>
                        <h5 class="card-title py-3">Total Send Money</h5>
                    </div>
                    <div class="card-body text-center">
                        
                        <p class="card-text font-weight-bolder">Total : {{ $totalSendMoney > 0 ? $totalSendMoney.' '.'BDT' :'No Transaction'}}</p>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mt-5 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                    <img src="https://img.icons8.com/color/48/000000/card-exchange.png"/>
                        <h5 class="card-title py-3">Transaction Log</h5>
                        
                    </div>
                    <div class="card-body text-center">
                        <div class="w-25">
                        <form action="{{route('admin.search')}}" method="POST" class="form-inline">
                            @csrf
                                <div class="form-group">
                                    <label for="">Search By Transaction ID : </label>
                                    <input type="text" class="form-control" name="trans">
                                    <input type="submit" class="form-control btn btn-info" value="Search">
                                </div>
                            </form>
                        </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Receiver</th>
                        <th>Tranx. Id</th>
                        <th>Amount</th>
                        <th>Charge</th>
                        <th>Balance</th>
                        <th>Stauts</th>
                        <th>Trx Time</th>
                    </tr>
                </thead>
                
                <tbody>
                @if(isset($transactionLog) == false)
                    <tr>
                        <td colspan="8"><p class="text-center text-warning">No Data Found</p></td>
                    </tr>
                @else
               
                @php($i = 1 )
                @foreach($transactionLog as $trans)
                <tr>
                <td>{{$i++}}</td>
                <td>{{$trans->user->username}}</td>
                <td>{{$trans->transaction_id}}</td>
                <td>{{$trans->amount}}</td>
                <td>{{$trans->charge}}</td>
                <td>{{$trans->balance}}</td>
                <td class="{{$trans->charge == 0 ? 'text-success':'text-danger '}} font-weight-bolder">{{$trans->status}}</td>
                <td>{{$trans->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
                {{$transactionLog->links()}}

                @endif
                </tbody>
            </table>
                    </div>
                </div>
            </div>

            
        </div>
    </div>



@endsection