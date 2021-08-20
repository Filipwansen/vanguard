@extends('layouts.app')

@section('page-title', __('Company'))
@section('page-heading', __('Company'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Add Company')
    </li>
@stop

@section('content')

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
               Company Details
            </h5>
            <p class="text-muted font-weight-light">
               New registeration for company with the application.
            </p>
         </div>
         <div class="col-md-9">
            <form action="{{ route('post.company') }}" 
                  method="post" 
                  enctype="multipart/form-data" 
                  novalidate="novalidate" 
                  accept-charset="UTF-8" 
                  autocomplete="off"
                  id="add-company-form"
                  >
                @csrf
                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input  type="text" 
                            class="form-control input-solid" 
                            id="name" 
                            placeholder="(Company Name)" 
                            name="name"                            
                            value="">
                </div>                
                <div class="form-group">
                    <label for="cif">CIF</label>
                    <input type="text" class="form-control input-solid" id="cif" placeholder="CIF" name="cif" value="">
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control input-solid" id="address" placeholder="Address" name="address" value="">
                </div>
                <!-- User List selection -->
                <div class="form-group">
                    <label for="usersa">Users</label>
                    <div class="form-group">
                        <select id="users" multiple="multiple">
                            @foreach(\Vanguard\User::all() as $key=>$user)
                                <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="users" style="opacity:0">
                    </div>
                </div>                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btn-company">Create Company</button>
                    <a class="btn btn-danger" href="{{ url('company') }}"><i class="fas fa-angle-double-left"></i> Back</a>
                </div>
            </form>            
         </div>
      </div>
   </div>
</div>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/company.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\CompanyRequest', '#add-company-form') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#users').multiselect({
                onDropdownShow: function(event) {
                                    console.log('Dropdown shown.');
                                    $('.content-page').css('overflow','');
                                }
            });
        });

        $('#add-company-form').on('submit', function(e){
            let ss = $('#users').val();
            $('input[name="users"]').val(ss);
        });
    </script>
@stop
