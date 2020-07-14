@extends('admin.dashboardlayout')

@section('content')
<h3>Transaction Search</h3>
<table class="table table-bordered mt-5" width="100%" cellspacing="0">
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
    @if($transaction->count() == 0)
        <tr>
            <td colspan="8"><p class="text-center text-warning">No Data Found</p></td>
        </tr>
    @else
   
    @php($i = 1 )
    @foreach($transaction as $trans)
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
    @endif
    </tbody>
</table>

@endsection