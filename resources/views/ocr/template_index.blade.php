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
        <div class="row my-3 flex-md-row flex-column-reverse">
            <div class="col-md-6">
                <h4>JSON OCR Templates</h4>
            </div>
            <div class="col-md-6"></div>
        </div>
        <div class="table-responsive">
            <table id="template" class="table table-borderless table-striped table-dashboard">
            <thead>
                <tr>
                    <th class="min-width-80">No</th>
                    <th class="min-width-150">User Name</th>
                    <th class="min-width-100">Template Name</th>
                    <th class="min-width-100">Description</th>
                    <th class="min-width-80">Created Date</th>
                    <th class="text-center min-width-150">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($templates as $key => $template)            
                <tr>
                    <td style="width: 40px;">{{ $key+1 }}</td>
                    <td class="align-middle">
                       <a href="{{url('users').'/'.$template->user->id}}">{{ ucfirst($template->user->username) }}</a>
                    </td>
                    <td class="align-middle">
                        <?php $companyName = Vanguard\User::find($template->user_id)->company->name; ?>
                        <a href="{{url('upload/templates').'/'.$companyName.'/'.$template->template_name}}" target="_blank">
                            {{ ucfirst($template->template_name) }}
                        </a>
                    </td>
                    <td class="align-middle">{{ ucfirst($template->description) }}</td>
                    <td class="align-middle">{{ date('Y-m-d H:i', strtotime($template->created_at)) }}</td>
                    <td class="text-center align-middle">
                        <a href="{{url('download/template').'/'.$template->id}}" class="btn btn-icon download" title="" data-toggle="tooltip" data-placement="top" data-original-title="Download Template">
                            <i class="fa fa-download"></i>
                        </a>
                        <a href="{{ url('template').'/'.$template->id.'/edit' }}" class="btn btn-icon edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Template Info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('template').'/'.$template->id }}" class="btn btn-icon" title="" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this template?" data-confirm-delete="Yes, delete it!" data-original-title="Delete Template">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach               
            </tbody>
            </table>
        </div>
   </div>
</div>
@stop

@section('scripts')
<!-- DataTables -->
<script type="text/javascript">
    $(function () {
        $('#template').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
@stop


