@extends('layout.app')

@section('content')
<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-md-12 p-5">
            <button class="btn btn-primary my-3" id="adNewId">
                Add New
            </button>
            <table cellspacing="0" class="table table-striped table-bordered" id="TableId" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">
                            UserName
                        </th>
                        <th class="th-sm">
                            Gender
                        </th>
                        <th class="th-sm">
                            Speciality
                        </th>
                        <th class="th-sm">
                            DOB
                        </th>
                        <th class="th-sm">
                            Photo
                        </th>
                        <th class="th-sm">
                            Status
                        </th>
                        <th class="th-sm">
                            Image
                        </th>
                        <th class="th-sm">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="othercrud_table">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container" id="loadDiv">
    <div class="row">
        <div class="col-md-12 text-center p-5">
            <img class="loading-icon" src="{{asset('images/loader.gif')}}">
            </img>
        </div>
    </div>
</div>
<div class="container d-none" id="errDiv">
    <div class="row">
        <div class="col-md-12 p-5">
            <h3>
                Data Not Found. Something went wrong
            </h3>
        </div>
    </div>
</div>
<!-- Modal For Add  -->
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="addModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header" style="background-color: #17A2B8;">
                <p class="heading">
                    Add New
                </p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card text-primary bg-gray">
                            <div class="card-body">
                                <div class="form-group row" id="md-name">
                                    <label class="col-sm-4 col-form-label text-md-right" for="basiccrud_id">
                                        User Name
                                    </label>
                                    <div class="col-sm-8">
                                        {!! Form::select('basiccrud_id',$BasicCrud,null,array('id'=>'basiccrud_id','class'=>'form-control d-block')) !!}
                                    </div>
                                </div>
                                <div class="form-group row" id="md-name">
                                    <label class="col-sm-4 col-form-label text-md-right" for="gender">
                                        Gender
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="gender1" name="gender" type="radio" value="M">
                                                <label class="form-check-label" for="gender1">
                                                    Male
                                                </label>
                                            </input>
                                        </div>
                                        <!-- Material inline 2 -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="gender2" name="gender" type="radio" value="F">
                                                <label class="form-check-label" for="gender2">
                                                    Female
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="md-name">
                                    <label class="col-sm-4 col-form-label text-md-right" for="speciality">
                                        Speciality
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="speciality1" name="speciality[]" type="checkbox" value="PHP">
                                                <label class="form-check-label" for="speciality1">
                                                    PHP
                                                </label>
                                            </input>
                                        </div>
                                        <!-- Material inline 2 -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="speciality2" name="speciality[]" type="checkbox" value="MySql">
                                                <label class="form-check-label" for="speciality2">
                                                    MySql
                                                </label>
                                            </input>
                                        </div>
                                        <!-- Material inline 3 -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="speciality3" name="speciality[]" type="checkbox" value="Java">
                                                <label class="form-check-label" for="speciality3">
                                                    Java
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="speciality4" name="speciality[]" type="checkbox" value="Oracle">
                                                <label class="form-check-label" for="speciality4">
                                                    Oracle
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="speciality5" name="speciality" type="checkbox" value="Python">
                                                <label class="form-check-label" for="speciality5">
                                                    Python
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-md-right" for="dob">
                                        DOB
                                    </label>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a class="btn btn-danger waves-effect" data-dismiss="modal" type="button">
                    Cancel
                </a>
                <button class="btn btn-primary" type="button" class="btn btn-success" id="AddBtnClickId">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal For Add Image -->
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="photoModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 text-center">
                <h5 class="modal-title">
                    Add Photo
                </h5>
                <input id="ImgId" type="text" value="">
                </input>
            </div>
            <div class="modal-body">
                <input id="imgInput" type="file">
                    <img id="imgPreview" src="" style="width: 100px; height: 100px;">
                    </img>
                </input>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Close
                </button>
                <button class="btn btn-success" id="photoAddBtn" type="button">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal For Delete -->
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="deleteModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h6>
                    Are You Sure about Delete ?
                </h6>
                <input id="DeleteId" type="hidden" value="">
                </input>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Close
                </button>
                <button class="btn btn-danger" id="DelConfirmBtn" type="button">
                    Delete
                </button>
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
            var gender = dataJSON[i].gender == 'M' ? 'Male' : 'Female';
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

  //Add New Btn Clik
  $('#adNewId').click(function() {
    $('#addModal').modal('show');
  });


  //Confirm Save
  $('#AddBtnClickId').click(function() {
    var username = $('#basiccrud_id').val();
    var gender = $('input[name="gender"]:checked').val();
    var speciality = $('input[type=checkbox]:checked').map(function(_, el) {
        return $(el).val();
    }).get();

    var speciality=speciality.toString();    


    othercrudAddClick(username, gender, speciality);
  })


  // Method for Click Add Btn
  function othercrudAddClick(username, gender, speciality) {

    if (gender.length == 0) {
      alert('Gender Required');
    } else {
      $('#AddBtnClickId').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
      axios.post('/othercrudAdd', {

          username: username,
          gender: gender,
          speciality: speciality,

        })
        .then(function(response) {
          $('#AddBtnClickId').html("Add");
          if (response.data == 1) {
            $('#addModal').modal('hide');
            toastr.success('Save Successfully');
            getOtherCrudData();
          } else {
            $('#addModal').modal('hide');
            toastr.error('Error in Save');
            getOtherCrudData();
          }
        })
        .catch(function(error) {
          $('#addModal').modal('hide');
            toastr.error('Error in Save');
            getOtherCrudData();
        });
    }

  }

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
