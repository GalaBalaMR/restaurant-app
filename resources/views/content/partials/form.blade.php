<a href="#" class="content-form-a text-warning text-center m-auto" >Zmeniť</a>
<div class="content-form-div">
  <form action="{{ route('contents.update', $content->id) }}" method="post" class="content-form-update" >
      @csrf
      @method('PUT')
      <div class="row">

        <input type="hidden" name="name" value="{{ $content->name }}">

        <div class="col-lg-8 col-md-6 form-group m-auto text-center mb-3">
          <label for="content" class="form-label">{{ $content->name }}</label>
          <textarea name="content" class="form-control content-textarea" id="content" >{{ old('content', $content->content) }}</textarea>
        </div>

      </div>
      <div class="text-center"><button type="submit">Uložiť obsah</button></div>
  </form>
</div>