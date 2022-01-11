@extends('layout.app')

@section('content')

<div id="mainDiv" class="container">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewId" class="btn btn-primary my-3">Add New</button>


      <table id="crudTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Full Name</th>
            <th class="th-sm">Email</th>
            <th class="th-sm">Mobile</th>
            <th class="th-sm">Address</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="crud_table">

        </tbody>

      </table>

    </div>
  </div>
</div>

<div id="loadDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
     <img class="loading-icon" src="{{asset('images/loader.gif')}}">

    </div>
  </div>
</div>

<div id="errDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
     <h3>Data Not Found. Something went wrong</h3>

    </div>
  </div>
</div>

<!-- Modal For Add  -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <p class="h4 mb-4">Add New Form</p>
        <div id="Addform">
          <input id="Add_nameId" type="text" class="form-control mb-4" placeholder="Enter  Name">
          
          <input id="Add_emailId" type="email" class="form-control mb-4" placeholder="Enter  Email">
          
          <input id="Add_mobileId" type="text" class="form-control mb-4" placeholder="Enter  Mobile">
          
          <textarea class="form-control mb-4" id="Add_addressId" rows="4" placeholder="Enter Address"></textarea>
          
        </div>        

          <img id="AddLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="AddBtnClickId" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    //Add New Btn Clik

    $('#adNewId').click(function(){
    $('#addModal').modal('show');
    });


</script>
@endsection

