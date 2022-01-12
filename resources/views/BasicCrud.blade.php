@extends('layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewId" class="btn btn-primary my-3">Add New</button>

      <table id="TableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        <tbody id="basiccrud_table">

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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal For Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body text-center">
        <h6>Are You Sure about Delete ?</h6>
        <input id="DeleteId" value="" type="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="DelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<!--  Edit  Modal -->
<div class="modal fade" id="editBasicCrudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body  text-center">
        <div class="container">
          <div class="row">
            <p class="h4 mb-4 text-center">Update Basic Crud</p>
            <input id="EditId" value="" type="hidden">
            <input id="nameIdU" type="text" class="form-control mb-3">
            <input id="emailIdU" type="text" class="form-control mb-3">
            <input id="mobileIdU" type="text" class="form-control mb-3">
            <input id="addressIdU" type="text" class="form-control mb-3">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="UpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  getBasicCrudData();

  function getBasicCrudData() {

    axios.get('/basicCrudData')
      .then(function(response) {

        if (response.status == 200) {

          $('#mainDiv').removeClass('d-none');
          $('#loadDiv').addClass('d-none');

          $('#TableId').DataTable().destroy();
          $('#basiccrud_table').empty();

          var dataJSON = response.data;
          $.each(dataJSON, function(i, item) {
            $('<tr>').html(
              "<td>" + dataJSON[i].full_name + "</td>" +
              "<td>" + dataJSON[i].email + "</td>" +
              "<td>" + dataJSON[i].mobile + "</td>" +
              "<td>" + dataJSON[i].address + "</td>" +
              "<td><a class='EditBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-edit'></i></a></td>" +
              "<td><a class='DeleteBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#basiccrud_table');
          });

          //Delete Icon
          $('.DeleteBtn').click(function() {
            var id = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#DeleteId').val(id);
          })

          //Edit Icon
          $('.EditBtn').click(function() {
            var id = $(this).data('id');

            $('#EditId').val(id);
            basicCrudUpdate(id);
            $('#editBasicCrudModal').modal('show');
          })


        } else {
          $('#errDiv').removeClass('d-none');
          $('#loadDiv').addClass('d-none');
        }

      })
      .catch(function(error) {
        $('#errDiv').removeClass('d-none');
        $('#loadDiv').addClass('d-none');
      });
  }

  //Add New Btn Clik
  $('#adNewId').click(function() {
    $('#addModal').modal('show');
  });


  //Confirm Save
  $('#AddBtnClickId').click(function() {
    var name = $('#Add_nameId').val();
    var email = $('#Add_emailId').val();
    var mobile = $('#Add_mobileId').val();
    var address = $('#Add_addressId').val();

    basiccrudAddClick(name, email, mobile, address);
  })


  // Method for Click Add Btn
  function basiccrudAddClick(name, email, mobile, address) {

    if (name.length == 0) {
      toastr.error('Name Required');
    } else if (mobile.length == 0) {
      toastr.error('mobile Required');
    } else if (address.length == 0) {
      toastr.error('address Required');
    } else {
      $('#AddBtnClickId').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
      axios.post('/basiccrudAdd', {

          full_name: name,
          email: email,
          mobile: mobile,
          address: address,

        })
        .then(function(response) {
          $('#AddBtnClickId').html("Add");
          if (response.data == 1) {
            $('#addModal').modal('hide');
            toastr.success('Save Successfully');
            getBasicCrudData();
            $('#Add_nameId').val('');
            $('#Add_emailId').val('');
            $('#Add_mobileId').val('');
            $('#Add_addressId').val('');
          } else {
            $('#addModal').modal('hide');
            toastr.error('Error in Save');
            getBasicCrudData();
          }
        })
        .catch(function(error) {});
    }

  }

  //Confirm Delete
  $('#DelConfirmBtn').click(function() {
    var id = $('#DeleteId').val();
    basicCrudDelete(id);
  })

  // Method for Confirm Delete Data
  function basicCrudDelete(delid) {
    //Animation
    $('#DelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/basiccruddelete', {
        id: delid
      })
      .then(function(response) {
        $('#DelConfirmBtn').html("Delete");
        if (response.data == 1) {
          $('#deleteModal').modal('hide');
          toastr.success('Delete Successfully');
          getBasicCrudData();
        } else {
          $('#deleteModal').modal('hide');
          toastr.error('Error in Delete');
          getBasicCrudData();
        }
      })
      .catch(function(error) {

      });
  }


  // Method for Edit Icon Click
  function basicCrudUpdate(detailsid) {

    axios.post('/basicCrudDetails', {
        id: detailsid
      })
      .then(function(response) {
        if (response.status == 200) {

          var jsonData = response.data;
          $('#nameIdU').val(jsonData[0].full_name);
          $('#emailIdU').val(jsonData[0].email);
          $('#mobileIdU').val(jsonData[0].mobile);
          $('#addressIdU').val(jsonData[0].address);

        } else {
          $('#errDiv').removeClass('d-none');
          $('#loadDiv').addClass('d-none');
        }
      })
      .catch(function(error) {
        $('#errDiv').removeClass('d-none');
        $('#loadDiv').addClass('d-none');
      });
  }


  //Confirm Edit
  $('#UpdateConfirmBtn').click(function() {
    var id = $('#EditId').val();
    var name = $('#nameIdU').val();
    var email = $('#emailIdU').val();
    var mobile = $('#mobileIdU').val();
    var address = $('#addressIdU').val();
    UpdateClick(id, name, email, mobile, address);
  })

  // Method for Click Update Btn
  function UpdateClick(id, name, email, mobile, address) {

    if (name.length == 0) {
      toastr.error('Name Required');
    } else if (mobile.length == 0) {
      toastr.error('mobile Required');
    } else if (address.length == 0) {
      toastr.error('address Required');
    } else {
      $('#UpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
      axios.post('/basicCrudUpdateClick', {
          id: id,
          full_name: name,
          email: email,
          mobile: mobile,
          address: address,

        })
        .then(function(response) {
          $('#UpdateConfirmBtn').html("Update");
          if (response.data == 1) {
            $('#editBasicCrudModal').modal('hide');
            toastr.success('Update Successfully');
            getBasicCrudData();
          } else {
            $('#editBasicCrudModal').modal('hide');
            toastr.error('Error in Update');
            getBasicCrudData();
          }
        })
        .catch(function(error) {});
    }

  }
</script>
@endsection