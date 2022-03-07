<div class="modal fade right" id="modal-new-hrmCrud" tabindex="-1" role="dialog" aria-labelledby="modal-new-hrmCrud-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action="" id="hrmCrud-add-form"  method="post" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">New Hrm Crud
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-primary bg-gray border-primary">

                                <div class="card-body">                                    

                                    <div class="form-group row required">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row required">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="email" id="email" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-4 col-form-label text-md-right">Mobile</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="mobile" id="mobile" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row required">
                                        <label for="dob" class="col-sm-4 col-form-label text-md-right">Date of Birth</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                            <input class="form-control" id="dob" name="dob" readonly="" type="text" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-4 col-form-label text-md-right">Gender</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                {!! Form::select('gender',['M' => 'Male', 'F' => 'Female'],null,array('id'=>'gender','class'=>'form-control d-block')) !!}
                                            </div>                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                </div>

            </div>
            <!--/.Content-->
        </form>
    </div>
</div>
<!-- Modal: modalAbandonedCart-->
