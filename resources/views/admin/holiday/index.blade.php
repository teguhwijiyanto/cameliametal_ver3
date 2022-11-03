@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('templates.partials.alerts')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Holiday List</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{route('admin.holiday.create')}}" class="btn btn-primary">Add Holiday</a>         
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> 
                    </div>          
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->   
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete" style="display:none">
    </form>
@endsection

@push('scripts')
<script>
    $(function () {
      $('#dataTable').DataTable({
        processing:true,
        serverSide:true,
        ajax:'{{route('admin.holiday.data')}}',
        columns:[
            {data:'DT_RowIndex',orderable:false, searchable:false},
            {data:'name'},
            {data:'action'}
        ],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush