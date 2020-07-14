@extends('admin.dashboardlayout')

@section('content')

@include('admin.navbar')
<div class="row justify-content-center mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Add Currency</h3>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
        <p class="alert alert-success">{{session('success')}}</p>
            @endif
        <form action="{{route('admin.currency')}}" method="POST">
            @csrf
                <div class="form-group">
                    <input type="text" name="currency" placeholder="input currency" class="form-control">
                </div>
                @if($errors->has('currency'))
            <p class="alert alert-danger">{{$errors->first('currency')}}</p>
            @endif
                <div class="form-group">
                    <input type="submit" value="Add Currency" class="form-control btn btn-danger">
                </div>
            </form>
        </div>
    </div>
    
</div>


<div class="row justify-content-center mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Currency Change</h3>
        </div>

        <div class="card-body">
        <form action="{{route('admin.changeCurrency')}}" method="POST">
                @csrf
                <div class="form-group">
                    <select name="currency_change" id="" class="form-control">
                        @foreach($currency as $currencies)
                    <option value="{{$currencies->id}}">{{$currencies->currency}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Change Currency" class="btn btn-danger"> 
                </div>
            </form>
        </div>
    </div>
    
</div>


@endsection