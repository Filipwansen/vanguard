@extends('layouts.app')

@section('page-title', __('Key For Companies'))
@section('page-heading', __('OCR keys'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Key For Companies')
    </li>
@stop

@section('content')

@if($message=Session::get('notify'))
<div class="alert alert-success alert-block col-md-8 offset-md-2">
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
        <div class="row my-3 flex-md-row flex-column-reverse">
            <div class="col-md-6">
                <h4>Key Generate</h4>
            </div>
            <div class="col-md-6"></div>
        </div>        
        <div class="col-md-12">
            <form action="{{ route('post.key.company') }}" 
                  method="post" 
                  enctype="multipart/form-data" 
                  novalidate="novalidate" 
                  accept-charset="UTF-8" 
                  autocomplete="off"
                  id="keygen-form"
                  >
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <div class="form-group">
                                <select id="company_id" class="form-control" name="company_id">
                                    <option value="">Select Company</option>
                                    @foreach(\Vanguard\companies::all() as $key=>$company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <label for="key">Key</label>
                        <input type="text" class="form-control input-solid" id="key" placeholder="OCR Key" name="key" value="" readonly>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="key">Expire Date</label>
                        <input  type="date" 
                                class="form-control input-solid" 
                                value="{{ date('Y-m-d') }}" 
                                min="{{ date('Y-m-d') }}" 
                                max="2050-12-31"
                                placeholder="dd-mm-yyyy"
                                name="expire_date"
                                >
                    </div>

                    <div class="col-md-1">
                        <label for="generator">Generate</label>
                        <a class="form-control btn btn-primary" id="generator" style="color:white;"><i class="fas fa-redo"></i> </a>
                    </div>
                </div>

                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary" id="btn-company"><i class="fas fa-save"></i>&nbsp; Save &nbsp;</button>
                    <a class="btn btn-danger" href="{{ url('company') }}"><i class="fas fa-angle-double-left"></i> Company</a>
                </div>
            </form>
        </div>
   </div>
</div>
@stop

@section('scripts')
{!! JsValidator::formRequest('Vanguard\Http\Requests\Company\OcrKeyRequest', '#keygen-form') !!}
<script>
    /* >> deinfine key gen */
    function keygen() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 70; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    $('#generator').on('click', function(e){
        let key_gen = keygen();
        $('#key').val(key_gen);
    })
</script>
@stop


