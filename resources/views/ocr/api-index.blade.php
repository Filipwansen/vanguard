@extends('layouts.app')

@section('page-title', __('How to API'))
@section('page-heading', __('API'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('API how to use')
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
            <div class="col-md-12" style="padding-bottom: 10px;">
                <h4>OCR Api document</h4>
            </div>
            <div class="col-md-12" style="padding-bottom: 10px;">
                <div class="method method-post">Method: POST</div>
                <div class="method method-post">URL: 
                    <span style="color: #476582;padding: .25rem .5rem;margin: 0; font-size: 12pt; background-color: rgba(27,31,35,.05);
    border-radius: 3px;">{{ url('api')}}/ocr</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"> 
                <table class="table">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>token</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>bearer token to be used for authentication</td>
                        </tr>
                        <tr>
                            <td>key</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Api validate key for OCR template/engine</td>
                        </tr>
                        <tr>
                            <td>img</td>
                            <td>file</td>
                            <td>Yes</td>
                            <td>image file(jpeg,jpg,png) to be processed</td>
                        </tr>
                    </tbody>
                </table>  
            </div>      
        </div>  
      <div class="row">
        <div class="col-md-12">
            <h6>Example Request</h6>
        </div> 
        <div class="col-md-12">
            <div class="col-md-6 code" style="background-color:#282c34; color: white; border-radius: 5px; padding: 10px 0px; padding-left: 25px; min-width: 680px;">
                <p>
                <span class="curl">curl</span> --location --request POST <span class="content">'https://website.com/api/ocr'</span> \<br>
                --header <span class="content"> 'Accept: application/json'</span> \<br>
                --header <span class="content"> 'Content-Type: application/json'</span> \<br>
                --header <span class="content"> 'Authorization: Bearer { token }'</span><br>
                --data-raw <span class="content"> '{ <br>
                    <span class="content"> "key": "0OLPCevqN7YtYMBvrqapLdA0DeI2GkgigrfUXjd6YdFMLUhTD17dBaug7NdPmRHl6KhMNv",</span><br>
                    <span class="content"> "img": "xx.jpg"</span><br>
                    <span class="content"> }'</span>
                </p>                
            </div>
            <div class="col-md-6">
            
            </div>
        </div> 

        <div class="col-md-12" style="margin-top: 50px;">
            <h6>Response Example</h6>
        </div>       
        <div class="col-md-12">
            <pre class="col-md-6 response">
            {
                "response": "success",
                "content": {
                    "Module": [
                        {
                            "DocType": "",
                            "page": [
                                {
                                    "PageNumber": "0",
                                    "PageItems": [
                                        {
                                            "Label": "TOTAL",
                                            "Value": "406.90 "
                                        },
                                        {
                                            "Label": "TOTAL TVA",
                                            "Value": "64.97 "
                                        },
                                        {
                                            "Label": "TVA A",
                                            "Value": "64.97 "
                                        },
                                        {
                                            "Label": "CARD",
                                            "Value": "406.90 "
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            }
            </pre>
            <div class="col-md-4"></div>
        </div>

      </div>
   </div>
</div>

<style>
div[class*=language-] {
    position: relative;
    background-color: #282c34;
    border-radius: 6px;
}
.curl{ color: #f08d49;}
.content{ 
    color: #7ec699;
    padding-left: 10px;
}
.code, .response{
    background-color:#282c34; color: white; border-radius: 5px; padding: 10px 0px; padding-left: 25px; min-width: 680px;
}
.code:before{
    content: "sh";
    float: right;
    padding-right: 5px;
    color: hsla(0,0%,100%,.4);
}
.response:before{
    content: "json";
    float: right;
    color: hsla(0,0%,100%,.4);
    padding-right: 10px;
}
</style>
@stop

