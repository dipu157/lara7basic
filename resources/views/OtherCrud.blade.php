@extends('layout.app')

@section('content')

<div id="mainDiv" class="container">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewId" class="btn btn-primary my-3">Add New</button>

      <table id="TableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">UserName</th>
            <th class="th-sm">Gender</th>
            <th class="th-sm">Speciality</th>
            <th class="th-sm">DOB</th>
            <th class="th-sm">Photo</th>
            <th class="th-sm">Status</th>
            <th class="th-sm">Image</th>
            <th class="th-sm">Action</th>
          </tr>
        </thead>
        <tbody id="othercrud_table">

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

<!-- Modal For Add Image -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-3 text-center">
        <h5 class="modal-title">Add Photo</h5>
        <input id="ImgId" value="" type="text">
      </div>

      <div class="modal-body">
        <input id="imgInput" type="file">
        <img style="width: 100px; height: 100px;" src="" id="imgPreview">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="photoAddBtn" type="button" class="btn btn-success">Upload</button>
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
@endsection

@section('script')
<script type="text/javascript">
  getOtherCrudData();

  function getOtherCrudData() {

    axios.get('/otherCrudData')
      .then(function(response) {

        if (response.status == 200) {

          $('#mainDiv').removeClass('d-none');
          $('#loadDiv').addClass('d-none');

          $('#TableId').DataTable().destroy();
          $('#othercrud_table').empty();

          var dataJSON = response.data;


          $.each(dataJSON, function(i, item) {
            var gender = dataJSON[i].gender == 'm' ? 'Male' : 'Female';
            var status = dataJSON[i].status == 1 ? 'Active' : 'Inactive';
            $('<tr>').html(
              "<td>" + dataJSON[i].basic_crud['full_name'] + "</td>" +
              "<td>" + gender + "</td>" +
              "<td>" + dataJSON[i].speciality + "</td>" +
              "<td>" + dataJSON[i].dob + "</td>" +
              "<td><img class='table-img' alt='photo' src=" + dataJSON[i].photo + "></td>" +
              "<td>" + status + "</td>" +
              "<td><a class='PhotoBtn btn btn-info btn-sm' data-id=" + dataJSON[i].id + ">Upload</a></td>" +
              "<td><a class='EditBtn' data-id=" + dataJSON[i].id + "><i class='fas fa-edit'></i></a> &nbsp; &nbsp;" +
              "<a class='DeleteBtn' data-id=" + dataJSON[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#othercrud_table');
          });

          //Delete Icon
          $('.DeleteBtn').click(function() {
            var id = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#DeleteId').val(id);
          })

          // Upload Button/Icon Click to Modal Open

          $('.PhotoBtn').click(function() {
            var id = $(this).data('id');
            $('#photoModal').modal('show');
            $('#ImgId').val(id);
          });


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

  // Show the image on the preview box
  $('#imgInput').change(function() {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function(e) {
      var imageSource = e.target.result;
      $('#imgPreview').attr('src', imageSource);
    }
  });

  // Click Photo Save Button
  $('#photoAddBtn').on('click', function() {

    var id = $('#ImgId').val();

    $('#photoAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    var photoFile = $('#imgInput').prop('files')[0];
    var formData = new FormData();
    formData.append('photo', photoFile); // photo is the key && photoFile is Value
    var url = "/photoUp/"+id;

    axios.post(url, formData)
      .then(function(response) {

        if (response.status == 200 && response.data == 1) {
          $('#photoModal').modal('hide');
          $('#photoAddBtn').html('Upload');
          toastr.success("Photo Upload Successfully");
          getOtherCrudData();
        } else {
          $('#photoModal').modal('hide');
          $('#photoAddBtn').html('Upload');
          toastr.error("Photo Upload Failed");
          getOtherCrudData();
        }

      }).catch(function(error) {
        alert(error);
      })
  });

  //Confirm Delete
  $('#DelConfirmBtn').click(function() {
    var id = $('#DeleteId').val();
    otherCrudDelete(id);
  })

  // Method for Confirm Delete Data
  function otherCrudDelete(delid) {
    //Animation
    $('#DelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/othercruddelete', {
        id: delid
      })
      .then(function(response) {
        $('#DelConfirmBtn').html("Delete");
        if (response.data == 1) {
          $('#deleteModal').modal('hide');
          toastr.success('Delete Successfully');
          getOtherCrudData();
        } else {
          $('#deleteModal').modal('hide');
          toastr.error('Error in Delete');
          getOtherCrudData();
        }
      })
      .catch(function(error) {

      });
  }
</script>
@endsection