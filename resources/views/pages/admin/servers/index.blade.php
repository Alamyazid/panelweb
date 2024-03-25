@extends('layouts.master')
@section('scss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
              <div class="col-6">
                <h3>List Server {{ $categoryData->name }}</h3>
              </div>
              <div class="col-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">                                       
                      <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                      </svg></a></li>
                  <li class="breadcrumb-item">Dashboard</li>
                  <li class="breadcrumb-item active"> List Server {{ $categoryData->name }}</li>
                </ol>
              </div>
            </div>
          </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                      <div class="d-flex justify-content-between">
                          <h4>List Server {{ $categoryData->name }}</h4>
                        <a href="{{ route('admin.servers.create') }}" class="btn btn-primary">Add Servers</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped nowrap" style="width:100%" id="list-servers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Country</th>
                            <th>Host</th>
                            <th>ISP</th>
                            <th>Price Montly</th>
                            <th>Price Hourly</th>
                            <th>Limit</th>
                            <th>Current</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard-script.js') }}"></script>
<script>
    $(document).ready(function() {
        new DataTable('#list-servers', {
            processing: true,
            responsive: true,
            ajax: "{{ route('admin.servers.index', ['category' => $categoryData->slug]) }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'country', name: 'country' },
                { data: 'host', name: 'host' },
                { data: 'isp', name: 'isp' },
                { data: 'prices_montly', name: 'prices_montly' },
                { data: 'prices_hourly', name: 'prices_hourly' },
                { data: 'limit', name: 'limit' },
                { data: 'current', name: 'current' },
                { data: 'total', name: 'total' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
<script>
  function deleteServer(serverId) {
    var deleteServerRoute = '{{ route("admin.servers.destroy", ["serverId" => ":serverId"]) }}';
    if (confirm('Apakah Anda yakin ingin menghapus server ini?')) {
      var url = deleteServerRoute.replace(':serverId', serverId);
        $.ajax({
          url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == 'success') {
                  $('#list-servers').DataTable().ajax.reload();
                  swal("Success", response.message, "success", {buttons: false,timer: 2000,})
                } else {
                  $('#list-servers').DataTable().ajax.reload();
                  swal("Error", response.message, "error", {buttons: false,timer: 2000,})
                }
            },
            error: function (xhr, status, error) {
                // Tindakan yang ingin Anda lakukan jika terjadi kesalahan saat menghapus server
                // Misalnya, menampilkan pesan error atau melakukan pembaruan ulang halaman
                console.error('Terjadi kesalahan saat menghapus server:', error);
            }
        });
    }
}

</script>
@endpush