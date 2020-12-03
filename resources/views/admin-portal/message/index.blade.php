@extends('admin-portal.layout.master')

@section('title')
  <title>Portal Admin - Users | CHS</title>
@endsection

@section('headscript')
<link href="{{ asset('public/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/backend/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('public/backend/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('public/backend/vendors/datatables.net-for-export/buttons.min.css') }}">
@endsection

@section('content')

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Message</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content table-responsive">
        <table id="usertabel" class="table table-striped table-bordered no-footer display">
          <thead>
            <tr role="row">
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Email/Phone</th>
              <th>Pertanyaan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($get as $key)
            <tr>
              <td>{{ $key->created_at }}</td>
              <td>{{ $key->name }}</td>
              <td>
                  {{ $key->email }}
                  <br>
                  @if($key->phone){{ $key->phone }}@endif
              </td>
              <td>
                  <label>{{ $key->subject }}</label>
                  <div style="max-height: 150px; overflow-y: auto;">
                    {{ $key->message }}
                  </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script src="{{ asset('public/backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>

  <script src="{{ asset('public/backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-buttons/js/buttons.print.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-buttons/js/buttons.html5.js') }}"></script>

  <script src="{{ asset('public/backend/vendors/datatables.net-buttons/js/buttons.flash.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-buttons/js/buttons.colVis.js') }}"></script>

  <script src="{{ asset('public/backend/vendors/datatables.net-for-export/jszip.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-for-export/pdfmake.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-for-export/vfs_fonts.js') }}"></script>

  <script type="text/javascript">
    $('#usertabel').DataTable({
      dom: 'Bfrtip',
      lengthMenu: [
          [ 10, 25, 50 ],
          [ '10 rows', '25 rows', '50 rows' ]
      ],
      buttons: {
        buttons: [
          'pageLength', 'colvis', 'copy', 'print', 'pdf', 'csv', 'excel'
        ]
      }
    });
  </script>
@endsection