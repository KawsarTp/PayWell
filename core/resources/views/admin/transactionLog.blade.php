<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
       Transaction Log For All User
    </div>
    <div class="card-body">
        <div class="table-responsive">
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
                    @if(isset($trans_all) == false)
                    <tr>
                        <td colspan="8"><p class="text-center text-warning">No Data Found</p></td>
                    </tr>
                @else
                @php($i = 1 )
                @foreach($trans_all as $trans)
                <tr>
                <td>{{$i++}}</td>
                <td>{{$trans->user->username}}</td>
                <td>{{$trans->transaction_id}}</td>
                <td>{{$trans->amount}}</td>
                <td>{{$trans->charge}}</td>
                <td>{{$trans->balance}}</td>
                <td>{{$trans->status}}</td>
                <td>{{$trans->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
                {{ $trans_all->links() }}
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



