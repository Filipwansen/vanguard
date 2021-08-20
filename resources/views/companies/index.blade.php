@extends('layouts.app')

@section('page-title', __('Company'))
@section('page-heading', __('Company'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Company')
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
        <div class="row my-3 flex-md-row flex-column-reverse">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <a href="{{ route('add.company') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>Add Company</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="company" class="table table-borderless table-striped table-dashboard">
            <thead>
                <tr>
                    <th class="min-width-80">No</th>
                    <th class="min-width-150">Company Name</th>
                    <th class="min-width-100">Address</th>
                    <th class="min-width-80">CIF</th>
                    <th class="min-width-80">Users</th>
                    <th class="min-width-80">Registration Date</th>
                    <th class="text-center min-width-150">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($companies as $key => $company)
                <tr>
                    <td style="width: 40px;">{{ $key+1 }}</td>
                    <td class="align-middle">{{ ucfirst($company->name) }}</td>
                    <td class="align-middle">{{ ucfirst($company->address) }}</td>
                    <td class="align-middle">{{ ucfirst($company->cif) }}</td>
                    <td class="align-middle">{{ \Vanguard\User::where('company_id', $company->id)->count() }}</td>
                    <td class="align-middle">{{ date('Y-m-d H:i', strtotime($company->created_at)) }}</td>
                    <td class="text-center align-middle">
                        <a href="{{ url('company').'/'.$company->id.'/view' }}" class="btn btn-icon" title="" data-toggle="tooltip" data-placement="top" data-original-title="View Company">
                            <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="{{ url('company').'/'.$company->id.'/edit' }}" class="btn btn-icon edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Company">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('company').'/'.$company->id }}" class="btn btn-icon" title="" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this company?" data-confirm-delete="Yes, delete it!" data-original-title="Delete Company">
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
        $('#company').DataTable({
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


