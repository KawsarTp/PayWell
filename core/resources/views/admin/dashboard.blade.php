@extends('admin.dashboardlayout')

@section('content')
                
                
                <div class="row mt-5">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-secondary text-white mb-4">
                            <div class="card-body text-center">
                                <img src="https://img.icons8.com/dusk/64/000000/change-user-male.png"/>
                                <p class="pt-3">Total User : {{isset($totalUser)?count($totalUser) : "No User"}}</p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('admin.list')}}">View All User</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body text-center">
                                <img src="https://img.icons8.com/nolan/64/split-transaction.png"/>
                                <p class="pt-3">Total Transaction : {{count($totalTransaction) > 0?count($totalTransaction) : "No Transaction"}}</p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="{{route('admin.transaction')}}">View All Transaction</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info text-white mb-4">
                            <div class="card-body text-center">
                                <img src="https://img.icons8.com/color/64/000000/add-user-group-woman-man-skin-type-7.png"/>
                                <p class="pt-3">Total Reffered user: {{$totalRefferedUser >0? $totalRefferedUser :"No user"}} </p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View All Reffered User</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                                <div class="card-body text-center text-light">
                                    <img src="https://img.icons8.com/color/96/000000/admin-settings-male.png"/>
                                    <a href="" class="font-weight-bolder pt-1 d-block text-light">My Profile</a>
                                  </div>
                           
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">Change Setting</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                

                @include('admin.transactionLog')


                
            







@endsection