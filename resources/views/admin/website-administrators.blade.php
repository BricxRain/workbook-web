<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Website Administrator</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('admin.parts.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Website Administrator</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Website Administrator</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Administrator User List</h3>
                <button id="add" class="btn btn-success float-right">Add Administrator</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="administrator" class="table table-striped table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($administrators as $administrator)
                    <tr>
                      <td>{{ $administrator->id }}</td>  
                      <td>{{ $administrator->name }}</td>  
                      <td>{{ $administrator->email }}</td>
                      <td>
                        <button id="{{ $administrator }}" class="btn btn-info edit"><i class="fa fa-eye"></i> Edit</button>
                        <button id="{{ $administrator }}" class="btn btn-danger remove"><i class="fa fa-times-circle"></i> Remove</button>
                      </td>  
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Action</th>
                      </tr>
                  </tfoot>
                </table>    

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label for="">Name</label>
            <input class="form-control" type="text" name="name" id="name">

            <label for="">Email</label>
            <input class="form-control" type="email" name="email" id="email">
            
            <label for="">Password</label>
            <input class="form-control" type="password" name="password" id="password">

            <br>
            <span style="display: none;" class="error invalid-feedback spanEmail">Invalid email address.</span>
            <span style="display: none;" class="error invalid-feedback spanMessage">Make sure fields are not empty.</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id ="deleteSeeker">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <input class="form-control" type="hidden" id="id">

            <label for="">Name</label>
            <input class="form-control" type="text" name="name" id="name">

            <label for="">Email</label>
            <input class="form-control" type="email" name="email" id="email">

            <br>
            <span style="display: none;" class="error invalid-feedback spanEmail">Invalid email address.</span>
            <span style="display: none;" class="error invalid-feedback spanMessage">Make sure fields are not empty.</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id ="deleteSeeker">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label>Are you sure you want to delete this account?</label>
            <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id ="deleteSeeker">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <footer class="main-footer">
    <strong>Copyright &copy; 2020 WorkBook.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#administrator').DataTable();

      $("#add").click(function() {
        $("#addModal").modal("show");
      });

      $("#administrator").on('click', '.edit', function() {
        let user = JSON.parse($(this).attr('id'));
        $("#editModal").modal("show");
        $("#editModal #id").val(user.id);
        $("#editModal #name").val(user.name);
        $("#editModal #email").val(user.email);
      });

      $("#administrator").on('click', '.remove', function() {
        let user = JSON.parse($(this).attr('id'));
        $("#removeModal").modal("show");
        $("#removeModal #id").val(user.id);
      });

      $('#addModal').on('click', '#deleteSeeker', function() {
        let name = $('#addModal #name').val();
        let email = $('#addModal #email').val();
        let password = $('#addModal #password').val();
        
        if (!name || !email || !password || !validateEmail(email)) {
          if (!validateEmail(email)) {
            $("#addModal .spanEmail").css('display', 'block');
          } else {
            $("#addModal .spanEmail").css('display', 'none');
          }
          $("#addModal .spanMessage").css('display', 'block');
        } else {
          $("#addModal .spanMessage").css('display', 'none');
          $.ajax({
            url: `/administrator/add`,
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              name: name,
              email: email,
              password: password
            },
            success: function(data) {
              $("#addModal").modal("hide");
              location.reload();
              alert('Administrator has been added!');
            }
          });
        }
      });

      $('#editModal').on('click', '#deleteSeeker', function() {
        let id = $('#editModal #id').val();
        let name = $('#editModal #name').val();
        let email = $('#editModal #email').val();
        if (!name || !email || !validateEmail(email)) {
          if (!validateEmail(email)) {
            $("#editModal .spanEmail").css('display', 'block');
          } else {
            $("#editModal .spanEmail").css('display', 'none');
          }
          $("#editModal .spanMessage").css('display', 'block');
        } else {
          $.ajax({
            url: `/administrator/edit`,
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              id: id,
              name: name,
              email: email
            },
            success: function(data) {
              $("#editModal").modal("hide");
              location.reload();
              alert('Administrator has been updated!');
            }
          });
        }
      });

      $('#removeModal').on('click', '#deleteSeeker', function() {
        let id = $('#removeModal #id').val();
        $.ajax({
          url: `/administrator/delete`,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id: id
          },
          success: function(data) {
            $("#removeModal").modal("hide");
            location.reload();
            alert('Administrator has been deleted!');
          }
        });
      });

    });

    function validateEmail(email) {
      let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

  </script>

</body>
</html>