@extends('frontend.layoutdashboard')

@section('content')

@include('frontend.navbar')


<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Reffered User List</h3>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Reffered By</th>
                      </tr>
            </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($reffer_list as $reffer)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                      <td>{{$reffer->username}}</td>
                        <td>{{$reffer->email}}</td>
                      <td>{{auth()->user()->username}}</td>
                      </tr>
                      <tr>
                          @endforeach
            </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

@endsection