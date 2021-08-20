@extends('layouts.app')

@section('page-title', __('Template'))
@section('page-heading', __('Template'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('OCR JSON Template')
    </li>
@stop

@section('content')

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
            <h5 class="card-title">JSON OCR Templates</h5>
            <p class="text-muted font-weight-light">
               Update Template Info with the application.
            </p>
            <div class="col-md-12">
                <label>Built User  Created At:</label>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('users').'/'.$template->user->id }}">
                            @if(!empty($template->user->avatar))
                                <img class="rounded-circle img-responsive" width="40" src="{{ asset('upload/users').'/'.$template->user->avatar }}" alt="">
                            @else 
                                <img class="rounded-circle img-responsive" width="40" src="{{ asset('assets/img/profile.png') }}" alt="">
                            @endif
                            <div>{{ $template->user->username }}</div>
                        </a>
                    </div>
                    <div class="col-md-6" style="padding-top: 10px;">
                        <strong> {{ date('Y-m-d', strtotime($template->created_at)) }}</strong>
                    </div>
                </div>
            </div>

            
         </div>
         <div class="col-md-9">
            <form action="{{ url('update/template').'/'.$template->id }}" 
                  method="post" 
                  enctype="multipart/form-data" 
                  novalidate="novalidate" 
                  accept-charset="UTF-8" 
                  autocomplete="off"
                  id="update-template-form"
                  >
                @csrf
                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input  type="text" 
                            class="form-control input-solid" 
                            id="template_name" 
                            placeholder="(Template Name)" 
                            name="template_name"                            
                            value="{{$template->template_name}}">
                </div>                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="2" name="description" id="description">{{$template->description}}</textarea>
                </div>                
                <!--  -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Template</button>
                    <a class="btn btn-danger" href="{{ url('template') }}"><i class="fas fa-angle-double-left"></i> Back</a>
                </div>
            </form>            
         </div>
      </div>
   </div>
</div>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Template\UpdateTemplateRequest', '#update-template-form') !!}
@stop
