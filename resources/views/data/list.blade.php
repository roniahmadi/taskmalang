@extends('base')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Data
       <!--  <small>advanced tables</small> -->
      </h1>

 

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if(Session::get('flash-notif'))
          <div class="alert alert-{{ Session::get('flash-notif')['notif'] }}">{{ Session::get('flash-notif')['message'] }}</div>
          @endif
          
          <!-- /.box -->

          <div class="box"><br>

      
            <div class="box-header">
              <h3 class="box-title">Data </h3>

               <div class="box-tools pull-right">
                    <a href="{{route('data.create')}}" class="btn btn-primary btn-sm btn-flat" >
                          
                          Tambah Data
                    </a>
                 </div>
            </div>


            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Tlp</th>
                  <th>Gender</th>
                  <th>Foto</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>



                	@foreach($data as $d)
                		
                	
                <tr>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->email}}</td>
                  <td>{{$d->date}}</td>
                  <td>{{$d->telepon}}</td>
                  <td>{{$d->gender}}</td>
                  <td><img src="/foto/{{$d->foto}}" width="60" height="70"></td>
                  
                  <td class="text-center" style="width:150px;">
                      <form method="POST" action="{{route('data.destroy',$d->id)}}" accept-charset="UTF-8">
                      <a href="{{route('data.edit',$d->id)}}" class="btn btn-primary btn-sm btn-flat" >
                          Edit
                         </a>
                      <input name="_method" type="hidden" value="DELETE">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <input type="submit" class="btn btn-danger btn-sm btn-flat" onclick="return confirm('Anda yakin akan menghapus data ini?');" value="Hapus">

                      </form>
                  </td> 
                </tr>
               
             @endforeach
               
                </tbody>
                <tfoot>
                <tr>
                   <th>Nama</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Tlp</th>
                  <th>Gender</th>
                  <th>Foto</th>
                  <th>Action</th>


                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- page script -->
@endsection
@section('extrascript')
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection

