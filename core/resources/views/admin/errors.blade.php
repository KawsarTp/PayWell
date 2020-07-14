@if(session()->has('error'))
<p class="alert alert-danger">{{session('error')}}</p>
@endif

@if(session()->has('success'))
 <p class="alert alert-success">{{session('success')}}</p>
@endif


