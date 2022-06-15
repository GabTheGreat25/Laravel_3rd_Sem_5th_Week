{{-- @extends('layouts.base')
@section('body')
<div class="container">
    <br />
    @if ( Session::has('success'))
    <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
    </div><br />
    @endif
</div>
<div class="row">
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover'], true)}}
</div>
@push('scripts')
{{$dataTable->scripts()}}
@endpush
@endsection --}}
@extends('layouts.base')
@section('body')
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
  </div>
<div><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#artistModal">
  create new artist
</button></div>
  <div >
    {{$html->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
  </div>
  <div class="modal" id="artistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New Artist</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{url('artist')}}">
        {{csrf_field()}}
          
        <div class="modal-body mx-3" id="inputfacultyModal">
          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Artist Name</label>
            <input type="text" id="artist_name" class="form-control validate" name="artist_name">
          </div>
 <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
</div>
    </div>
    
  </div>
  @push('scripts')
    {{$html->scripts()}}
  @endpush
@endsection