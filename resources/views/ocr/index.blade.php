@extends('layouts.app')

@section('page-title', __('OCR Labeling'))
@section('page-heading', __('OCR'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('OCR Labeling')
    </li>
@stop

@section('content')
    <iframe src="http://localhost/nvanguard/public/ocrlabeling" width="100%" style="min-height: 800px;"></iframe>
    <!-- <iframe src="{{ url('ocrlabeling') }}" width="100%" style="min-height: 800px;"></iframe> -->
@stop

