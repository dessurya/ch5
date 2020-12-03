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
        Product Category
        <br>
        <p class="product_id error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <select
          id="product_id"
          class="form-control col-md-7 col-xs-12" 
          name="product_id" 
          type="text"
        >
          @foreach($productGrub as $list)
          <option value="{{$list->id}}" {{ $data != null and $data->product_id == $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
          @endforeach
        </select> 
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        name
        <br>
        <p class="name error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input 
          id="name"
          class="form-control col-md-7 col-xs-12" 
          name="name" 
          type="text"
          value="{{ $data != null ? $data->name : '' }}" 
        >
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        descript
        <br>
        <p class="descript error"></p>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <textarea
          id="descript"
          class="form-control col-md-7 col-xs-12" 
          name="descript" 
          type="text"
        >{{ $data != null ? $data->descript : '' }}</textarea> 
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