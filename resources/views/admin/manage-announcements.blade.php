<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Announcements</title>

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
            <h1 class="m-0 text-dark">Manage Announcements</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Manage Announcements</li>
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
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Make Announcement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/announcement">
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label>Target</label>
                    <select class="form-control" name="target">
                      <option value = "1">Providers</option>
                      <option value = "2">Job Seekeres</option>
                      <option value = "3">Both Providers and Job Seekers</option>
                    </select>
                    @if ($errors->has('target'))
                        <span style="display: block;" class="error invalid-feedback">{{ $errors->first('target') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Enter subject">
                    @if ($errors->has('subject'))
                        <span style="display: block;" class="error invalid-feedback">{{ $errors->first('subject') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" rows="3" placeholder="Enter ...">{{ old('message') }}</textarea>
                    @if ($errors->has('message'))
                        <span style="display: block;" class="error invalid-feedback">{{ $errors->first('message') }}</span>
                    @endif
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary">Post Announcement</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Announcements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="announcements" class="table table-striped table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Target</th>
                      <th>Message</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($announcements as $announcement)
                    <tr>
                      <td>{{ $announcement->title }}</td>  
                      <td>
                        @if ($announcement->target == 1)
                        <span class="badge badge-primary">Providers</span>
                        @elseif ($announcement->target == 1)
                          <span class="badge badge-warning">Job Seekers</span>
                        @else
                        <span class="badge badge-info">Providers and Job Seekers</span>
                          
                        @endif
                      </td>  
                      <td>{{ $announcement->message }}</td>  
                      <td>{{ $announcement->created_date }}</td>  
                      <td>
                        <button type="button" id="{{ $announcement->id }}" class="btn btn-danger removeAnnounce">Remove</button>  
                      </td>  
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                      <th>Subject</th>
                      <th>Target</th>
                      <th>Message</th>
                      <th>Date Created</th>
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
          $('#announcements').DataTable(); 

          $("#announcements").on('click', '.removeAnnounce', function() {
            let id = $(this).attr('id');
            $.ajax({
              url: `/announcement/delete`,
              type: 'POST',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id : id
              },
              success: function(data) {
                location.reload();
              }
            });
          });
      });

  </script>

</body>
</html>