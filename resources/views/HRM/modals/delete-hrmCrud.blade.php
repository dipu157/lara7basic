<div class="modal fade right" id="hrmCrud-delete" tabindex="-1" role="dialog" aria-labelledby="hrmCrud-delete-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action="{{ route('hrm/hrmCrudDelete') }}"  method="post" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-primary bg-gray">

                                <div class="card-body">

                                    <div class="form-group row" id="md-name">
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <span style="font-size: 20px;">Are You Sure To Delete ??</span>
                                                <input type="hidden" name="id" id="id-delete" class="form-control">
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
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>

            </div>
            <!--/.Content-->
        </form>
    </div>
</div>
<!-- Modal: modalAbandonedCart-->