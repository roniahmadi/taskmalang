@extends('base')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    


    @include('template.sidebar')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data</h3>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('data.update',$id) }}" enctype="multipart/form-data">
              <div class="box-body">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}

                 <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="{{decrypt($data[0])}}">
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{decrypt($data[1])}}">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="date" class="col-sm-2 control-label">date of birth</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="date" placeholder="nama" name="date" value="{{decrypt($data[2])}}">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="tlp" class="col-sm-2 control-label">no telepon</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tlp" placeholder="nama" name="tlp" value="{{decrypt($data[3])}}">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="gender" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-10">
                    <select name="gender" class="form-control">
                      <option value="p">Perempuan</option>
                      <option value="l">Laki laki</option>
                      <!-- <option></option> -->
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">upload foto</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="foto" placeholder="foto" name="foto" value="{{$data[5]}}">
                  </div>
                </div>
                
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>
@endsection

@section('extrastyle')
<link rel="stylesheet" href="{{url('')}}/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endsection

@section('extrascript')
<script src="{{url('')}}/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $('input[name=date]').datepicker({
    autoclose:true,
    format:'yyyy-mm-dd'
  })
  $('select[name=gender]').val('{{decrypt($data[4])}}')
</script>
@endsection
