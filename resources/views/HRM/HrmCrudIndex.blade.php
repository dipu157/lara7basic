@extends('layouts.app')

@section('pagetitle')
    <h2 class="no-margin-bottom">Hrm Crud</h2>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <button type="button" class="btn btn-hrmCrud btn-success" data-toggle="modal" data-target="#modal-new-hrmCrud"><i class="fa fa-plus"></i>New</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{!! URL::previous() !!}"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="hrmCrud-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

    @include('HRM.modals.new-hrmCrud')
    @include('HRM.modals.edit-hrmCrud')
    @include('HRM.modals.hrm-file-upload-form')

@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#hrmCrud-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'hrmCrudDataTable',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'dob', name: 'dob' },
                    { data: 'gender', name: 'gender' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });


            $(this).on("click", ".btn-file-upload", function (e) {
                e.preventDefault();

                document.getElementById('id-for-update').value=$(this).data('rowid');
            });



        });

        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>

@endpush