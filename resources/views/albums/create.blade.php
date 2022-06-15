@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Create new album</h2>
  {{-- <form method="post" action="{{route('album.store')}}" > --}}
  <form method="post" action="{{route('album.store')}}" enctype="multipart/form-data">
  @csrf  
  {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
<div class="form-group">
    <label for="album_name" class="control-label">Title</label>
    <input type="text" class="form-control" id="album_name" name="album_name" >
  </div> 

    <div class="form-group">
    <label for="image" class="control-label">Album Cover</label>
    <input type="file" class="form-control" id="image" name="image" >
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror   
  </div> 

  <div class="form-group">
    <label for="genre" class="control-label">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre" >
  </div> 

  <div class="form-group"> 
    <label for="artist" class="control-label">Artist</label>
    <select class="form-select" name="artist_id" id="artist_name">
      @foreach($artists as $id => $artist)
        <option value="{{$id}}">{{$artist}}</option>
      @endforeach
    </select>
  </div>
  {{-- <div class="form-group"> 
    <label for="genre" class="control-label">Genre</label>
    <input type="text" class="form-control " id="genre" name="genre" >
  </div>
  <div class="form-group"> 
    <label for="year" class="control-label">Year</label>
    <input type="text" class="form-control" id="year" name="year">
  </div> --}}
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
</form> 
@endsection
