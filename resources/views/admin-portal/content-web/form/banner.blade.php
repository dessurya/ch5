<form 
  id="open" 
  action="{{ route('adpor.ccw.openform.store', ['index'=>$index]) }}{{ $data != null ? '?id='.encrypt($data->id) : '' }}" 
  method="POST" 
  class="form-horizontal form-label-left" 
  enctype="multipart/form-data"
>
  <div class="modal-header">
    <button 
      type="button" 
      class="close" 
      data-dismiss="modal" 
      aria-label="Close"
    >
      <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">{{ title_case(str_replace('_', ' ', $index)) }} | {{ $data == null ? 'Tambah Baru' : 'Ubah : '.$data->title }}</h4>
  </div>
  <div class="modal-body">
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        text_one
        <br>
        <p class="text_one error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input 
          id="text_one"
          class="form-control col-md-7 col-xs-12" 
          name="text_one" 
          type="text"
          value="{{ $data != null ? $data->text_one : '' }}" 
        >
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        text_two
        <br>
        <p class="text_two error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input 
          id="text_two"
          class="form-control col-md-7 col-xs-12" 
          name="text_two" 
          type="text"
          value="{{ $data != null ? $data->text_two : '' }}" 
        >
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        Gambar
        <br>
        <p class="picture error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input 
          id="picture"
          class="form-control col-md-7 col-xs-12" 
          name="picture" 
          type="file" 
          accept=".jpg,.png,.bmp"
        >
      </div>
      @if($data != null)
      <br><br>
      <div class="text-center">
          <a href="{{ asset('public/asset/picture/'.str_replace('_', '-', $index).'/'.$data->picture) }}">
            <img src="{{ asset('public/asset/picture/'.str_replace('_', '-', $index).'/'.$data->picture) }}" width="50%">
          </a>
      </div>
      @endif
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" id="submit">Simpan</button>
  </div>
</form>