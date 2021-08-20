@extends('layouts.app')

@section('page-title', __('OCR Labeling'))
@section('page-heading', __('OCR'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('OCR Labeling')
    </li>
@stop

@section('content')
    <div class="col-md-12">        
        <div class="alert alert-danger alert-block col-md-8 offset-md-2">
            <h4 style="text-align: center">Invalid Or Expired Key Code, Please purchase valid Key Code!</h4>
        </div>
    </div>
@stop

