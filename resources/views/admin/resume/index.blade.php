@extends('admin.layouts.admin_layout')
@section('content')
    <style type="text/css">
        .table td,
        .table th {
            font-size: 12px;
            line-height: 2.42857 !important;
        }
    </style>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height:1744.73px">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="https://www.primeplum.in/admin/home">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Resume</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Resume <small>Resume</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Resume</span>
                            </div>
                            <div class="actions">
                                {{-- <a href="http://127.0.0.1:8000/admin/create-resume" class="btn btn-xs btn-success">
                                    <i class="glyphicon glyphicon-plus"></i> Add New Resume
                                </a> --}}
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <div id="resume_datatable_wrapper" class="dataTables_wrapper no-footer">
                                    <div class="">
                                        <table class="table table-striped table-bordered table-hover dataTable"
                                            id="resume_datatable" role="grid" aria-describedby="resume_datatable_info">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="resume_datatable" aria-sort="ascending">UserName</th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="resume_datatable" aria-sort="ascending">Email</th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="resume_datatable" aria-sort="ascending">Phone No</th>
                                                    <th class="sorting_disabled" aria-label="Actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($resume)
                                                @php
                                                    // Group the resumes by user_id
                                                    $groupedResumes = [];
                                                    foreach ($resume as $item) {
                                                        $groupedResumes[$item->user_id][] = $item;
                                                    }
                                                    
                                                @endphp
                                                @foreach ($groupedResumes as $userId => $items)
                                                        <tr id="resume_dt_row_{{ $items[0]->resume_id }}" role="row" class="odd">
                                                            <td><span>{{ $items[0]->name }}</span></td>
                                                            <td><span>{{ $items[0]->email }}</span></td>
                                                            <td><span>{{ $items[0]->phone }}</span></td>
                                                            <td>
                                                                <a href="{{ route('edit.resume', ['user_id' => $items[0]->user_id]) }}" class="btn btn-default" title="Edit">
                                                                    Edit <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                             
                                                @endforeach
                                            @endif
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection

@push('scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resume_datatable').DataTable({
                paging: true,
                searching: true,
                info: true,
                lengthChange: true,
                scrollY: false // Disable vertical scrolling
            });
        });
    </script>
@endpush
