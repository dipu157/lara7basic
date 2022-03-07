@extends('layout.app')

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
    @include('HRM.modals.delete-hrmCrud')
    @include('HRM.modals.hrm-file-upload-form')

@endsection

@section('script')

    <script type="text/javascript">
    // Show data to index page on datatables
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
                    { data: 'photo', name: 'photo' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });

            $(this).on("click", ".btn-file-upload", function (e) {
                e.preventDefault();

                document.getElementById('id-for-update').value=$(this).data('rowid');
            });
        });

            $('#hrmCrud-table').on("click", ".btn-hrmcrud-edit", function (e) {
                e.preventDefault();

                var id = $(this).data('rowid');
                var name = $(this).data('name');
                var mobile = $(this).data('mobile');
                var email = $(this).data('email');
                var dob = $(this).data('dob');
                var gender = $(this).data('gender');

                document.getElementById('id-update').value=id;
                document.getElementById('name-update').value=name;
                document.getElementById('mobile-update').value=mobile;
                document.getElementById('email-update').value=email;
                document.getElementById('dob-update').value=dob;
                document.getElementById('gender-update').value=gender;

            });

            $('#hrmCrud-table').on("click", ".btn-hrmcrud-delete", function (e) {
                e.preventDefault();
                var id = $(this).data('rowid');
                document.getElementById('id-delete').value=id;
            });


        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

        // Add Btn Click
        $( function() {
        $('#hrmCrud-add-form').on("submit", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = 'newhrmCrudSave';
            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),

                error: function (request, status, error) {
                    alert(request.responseText);
                },
                success: function (data) {
                    $('#hrmCrud-table').DataTable().draw(false);
                    $('#modal-new-hrmCrud').modal('hide');
                },
            }).always(function (data) {
                $('#hrmCrud-table').DataTable().draw(false);
            });
        });

        $( "#dob" ).datetimepicker({
            format: 'd-m-Y',
            timepicker: false,
            closeOnDateSelect: true,
            scrollInput : false,
            inline:false
        });

        $( "#dob-update" ).datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            closeOnDateSelect: true,
            scrollInput : false,
            inline:false
        });
    } );

    // Photo Upload Code

    $('#hrmCrud-table').on("click", ".btn-photo", function (e) {
        e.preventDefault();

        document.getElementById('hrmPhoto_id').value = $(this).data('rowid');

        $('#hrmCrud-photo-upload').modal('show');

    });

    // image preview set in extra bootstrap file named imageupload and linked
    $('.imageupload').imageupload({
        allowedFormats: [ "jpg", "jpeg", "png" ],
        previewWidth: 250,
        previewHeight: 250,
        maxFileSizeKb: 2048
    });


    </script>

@endsection