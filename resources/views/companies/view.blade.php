@extends('layouts.app')

@section('page-title', __('Company'))
@section('page-heading', __('Company'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('View Company')
    </li>
@stop

@section('content')
<link rel="stylesheet" href="{{ asset('assets/toastr') }}/toastr.css"> 
@if($message=Session::get('notify'))
<div class="alert alert-success alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li>{{ $message }}</li>       
</div>
@endif
@if($message=Session::get('error_notify'))
<div class="alert alert-danger alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li>{{ $message }}</li>       
</div>
@endif
@include('partials.messages')
<div class="card">
   <div class="card-body">
      <div class="row">
         <div class="col-md-3">
            <h5 class="card-title">
               {{ ucfirst($company->name) }} Company Details
            </h5>
            <p class="text-muted font-weight-light">
               @lang('View registered company with the application.')
            </p>
            <div class="row">
                <div class="col-md-12">
                    <label for="key">Key:</label>
                    <textarea class="form-control" row="2" readonly id="myInput">{{$company->key}}</textarea>
                </div>
                <div class="col-md-12" style="text-align: right;">
                    <button class="btn btn-primary mt-1" onclick="myFunction()" style="padding: 5px;" title="Copy"><i class="fas fa-copy"></i></button>
                </div>
                
            </div>

            <div class="mt-2">
                <label for="expire_date">Expire Date:</label>
                <input type="text" class="form-control" value="{{$company->expire_date}}" readonly>
            </div>
         </div>
         <div class="col-md-9">

            <div class="form-group">
                <label for="name">Company Name: {!! '<b>'.$company->name.'</b>' !!}</label>                
            </div>                
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2"><label for="cif">CIF: <b>{{ $company->cif }}</b></label></div>
                    <div class="col-md-8" style="text-align: center"><label for="address">Address: <b>{{ $company->address }}</b></label></div>
                    <div class="col-md-2"><label for="address">Created: <b>{{ date('Y-m-d', strtotime($company->created_at)) }}</b></label></div>                
                </div>
            </div>                
            <div class="form-group">
                <div class="row">
                @foreach($users as $key => $user)
                    <div class="col-md-2" style="padding-bottom: 10px;">
                        <a href="{{ url('users').'/'.$user->id}}">
                            @if(!empty($user->avatar))
                                <img class="rounded-circle img-responsive" width="40" src="{{ asset('upload/users').'/'.$user->avatar }}" alt="">
                            @else 
                                <img class="rounded-circle img-responsive" width="40" src="{{ asset('assets/img/profile.png') }}" alt="">
                            @endif
                            <div>{{ $user->username }}</div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>                            
            <div class="form-group row">
                <div class="col-md-12" style="text-align: center">
                    <a class="btn btn-danger" href="{{ url('company') }}"><i class="fas fa-angle-double-left"></i> Back</a>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/as/company.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\CompanyRequest', '#add-company-form') !!}
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            toastr.success("Copied!");
        }
    </script>
@stop
