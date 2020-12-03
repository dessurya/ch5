@extends('admin-portal.layout.master')

@section('title')
  <title>Portal Admin - {{ title_case(str_replace('_', ' ', $index)) }} | CHS</title>
@endsection

@section('headscript')
  <link href="{{ asset('public/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
  <style type="text/css">
    div.content{
      max-height: 260px;
      max-width: 320px;
      margin: 0 auto;
      padding: 10px;
      letter-spacing: 1px;
      line-height: 2;
      overflow-y: auto;
    }
    img.picture{
      max-height: 220px;
      max-width: 280px;
    }
    p.error{
      color:red; 
      font-size:12px;
    }
    div#loading{
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 660px;
      height: 100%;
      height: 100vh;
      background-color: rgba(0,0,0,.8);
      display: none;
      z-index: 10000;
    }
    div#loading div#load{
      position: relative;
      display: table;
      width: 50%;
      margin: 0 auto;
    }
    div#loading div#load div#lod{
      display: table-cell;
      vertical-align: middle;
      width: 100%;
      height: 660px;
      height: 100%;
      height: 100vh;
    }
    div#loading div#load div#lod h3{
      color: blue;
    }
    div#loading div#load div#lod h3 strong{
      color: red;
    }
  </style>
  <script src="{{asset('public/backend/vendors/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
  <div class="modal fade modal-form-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content alert-info">
        
      </div>
    </div>
  </div>

  <div class="modal fade modal-aksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content alert-info">
        <div class="modal-header">
          <button 
            type="button" 
            class="close" 
            data-dismiss="modal" 
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="title-aksi"></h4>
        </div>
        <div class="modal-body">
          <h4>Yakin ?</h4>
          <p id="text-aksi">?</p>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary" id="aksi-url">Ya</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{ title_case(str_replace('_', ' ', $index)) }}</h2>
          <ul class="nav panel_toolbox">
            <div class="btn-group">
              <button 
                type="button"
                class="open btn btn-success btn-sm" 
                data-toggle='modal' 
                data-target='.modal-form-add'
                data-href="{{ route('adpor.ccw.openform', ['index' => $index, 'category' => $request->category]) }}"
              >
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-success">
                Status {{ $request->flag != '' ? ' : '.$request->flag : ' : Semua'}}
              </button>
              <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                <span class="caret" style="color:white;"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>'', 'author'=>$request->author, 'product'=>$request->product]) }}">
                    Semua
                  </a>
                </li>
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>'Publis', 'author'=>$request->author, 'product'=>$request->product]) }}">
                    Show Publis
                  </a>
                </li>
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>'Unpublis', 'author'=>$request->author, 'product'=>$request->product]) }}">
                    Show Unpublis
                  </a>
                </li>
              </ul>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-success">
                Pembuat {{ $request->author != '' ? ' : '.$getFilterAuthor->name : ' : Semua'}}
              </button>
              <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                <span class="caret" style="color:white;"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>$request->flag, 'author'=>'', 'product'=>$request->product]) }}">
                    Semua
                  </a>
                </li>
                @php $lastAuthor = 0 @endphp
                @foreach($authorList as $data)
                @if($lastAuthor != $data->user_id)
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>$request->flag, 'author'=>$data->getUser->email, 'product'=>$request->product]) }}">
                    {{ $data->getUser->name }}
                  </a>
                </li>
                @endif
                @php $lastAuthor = $data->user_id @endphp
                @endforeach
              </ul>
            </div>

            @if($index == 'product_detail')
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-success">
                Category {{ $request->product != '' ? ' : '.$request->product : ' : All'}}
              </button>
              <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                <span class="caret" style="color:white;"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>$request->flag, 'product'=>'']) }}">
                    Semua
                  </a>
                </li>
                @foreach($categoryList as $data)
                <li>
                  <a href="{{ route('adpor.ccw.index', ['index' => $index, 'flag'=>$request->flag, 'product'=>$data->name]) }}">
                    {{ $data->name }}
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
            @endif

            <div class="btn-group">
              <a 
                class="btn btn-success btn-sm"
                href="{{ route('adpor.ccw.index', ['index' => $index]) }}" 
              >
                <i class="fa fa-refresh"></i> Bersihkan Filter
              </a>
            </div>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">
          <table id="table-data" class="table table-striped table-bordered no-footer" width="100%">
            <thead>
              <tr role="row">
                <th>Dibuat</th>
                <th>Judul</th>
                <th>Penjelasan</th>
                <th>Pembuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>
  </div>

  <div id="loading">
    <div id="load">
      <div id="lod">
        <h3 class="text-center">
          Mohon Tunggu...!
          <br>
          <strong><label id="respon"></label></strong>
        </h3>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('public/backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('public/backend/vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>
  
  <script type="text/javascript">
    $(function(){

      var url = '{!! route('adpor.ccw.datatables', ['index' => $index, 'flag' => $request->flag, 'author' => $request->author, 'product' => $request->product]) !!}';

      var datatables = $('#table-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
          {data: 'created_at', orderable: true},
          {data: 'title'},
          {data: 'content'},
          {data: 'user_id'},
          {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
        }
      });

      $('#table-data').on('click', 'a.hapus', function(){
        var a = $(this).data('href');
        $('#aksi-url').attr('href', a);
        $('#title-aksi').html("Menghapus {{ title_case(str_replace('_', ' ', $index)) }}");
        $('#text-aksi').html("Menghapus {{ title_case(str_replace('_', ' ', $index)) }} Ini?");
      });
      $('#table-data').on('click', 'a.publis', function(){
        var a = $(this).data('href');
        $('#aksi-url').attr('href', a);
        $('#title-aksi').html("Batalkan Publikasi {{ title_case(str_replace('_', ' ', $index)) }}");
        $('#text-aksi').html("Batalkan Publikasi {{ title_case(str_replace('_', ' ', $index)) }} Ini?");
      });
      $('#table-data').on('click', 'a.unpublis', function(){
        var a = $(this).data('href');
        $('#aksi-url').attr('href', a);
        $('#title-aksi').html("Publikasikan {{ title_case(str_replace('_', ' ', $index)) }}");
        $('#text-aksi').html("Publikasikan {{ title_case(str_replace('_', ' ', $index)) }} Ini?");
      });

      $('div.modal-aksi').on('click', 'a#aksi-url', function(){
        var url   = $(this).attr('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
              // $('div#loading').show();
              // $('div#loading label#respon').html('Sedang Memproses Permintaan Anda...!');
            },
            success: function(data) {
              // $('div#loading label#respon').html(data.msg);
              window.setTimeout(function() {
                datatables.ajax.reload();
                // $('div#loading').hide();
                // $('div#loading label#respon').html('');
                $('div.modal.modal-aksi').modal('hide');
              }, 1500);
            }
        });
        return false;
      });

      $(document).on('click', '.open.btn', function(){
        var url   = $(this).data('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
              // $('div#loading').show();
              // $('div#loading label#respon').html('Sedang Memproses Permintaan Anda...!');
            },
            success: function(data) {
              // $('div#loading label#respon').html(data.msg);
              window.setTimeout(function() {
                // $('div#loading').hide();
                // $('div#loading label#respon').html('');
                $('div.modal-form-add div.modal-content').html(data.html);
                @if($index == 'product_detail')
                CKEDITOR.replace('descript');
                @endif
              }, 500);
            }
        })
        return false;
      });

      $(document).on('submit', 'form#open', function(){
        var url   = $(this).attr('action');
        // var data  = $(this).serializeArray(); // digunakan jika hanya mengirim form tanpa file
        var data  = new FormData($(this).get(0)); // digunakan untuk mengirim form dengan file

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            processData:false,
            contentType:false,
            beforeSend: function() {
              // $('div#loading').show();
              // $('div#loading label#respon').html('Sedang Memproses Permintaan Anda...!');
              $('form#open p.error').html('');
            },
            success: function(data) {
              // $('div#loading label#respon').html(data.msg);
              if (data.response == true) {
                window.setTimeout(function() {
                  // $('div#loading').hide();
                  // $('div#loading label#respon').html('');
                  $('div.modal-form-add div.modal-content').html('');
                  $('div.modal.modal-form-add').modal('hide');
                  datatables.ajax.reload();
                }, 500);
              }
              else{
                window.setTimeout(function() {
                  $.each(data.resault, function(key, val){
                    $('form#open p.'+key+'.error').html(val);
                  });
                  // $('div#loading').hide();
                  // $('div#loading label#respon').html('');
                }, 1500); 
              }
            }
        })
        return false;
      });

    });
  </script>
@endsection
