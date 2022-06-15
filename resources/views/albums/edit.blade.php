{{-- @extends('layouts.base')
@section('body')
<div class="container">
  <h2>Update Album</h2>
  <form method="post" action="{{route('album.update',$album->id)}}" >
  @csrf
  <div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$album->title}}" >
</div> 
  <div class="form-group"> 
    <label for="artist" class="control-label">Artist</label>
    <input type="text" class="form-control " id="artist" name="artist" value="{{$album->artist}}" ></text>
  </div> 
  <div class="form-group"> 
    <label for="genre" class="control-label">Genre</label>
    <input type="text" class="form-control " id="genre" name="genre" value="{{$album->genre}}">
  </div>
<div class="form-group"> 
    <label for="year" class="control-label">Year</label>
    <input type="text" class="form-control" id="year" name="year" value="{{$album->year}}">
  </div>

    <input type="hidden" class="form-control" id="id" name="id" value="{{$album->id}}">
  <button type="submit" class="btn btn-primary">Update</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
</form> 
@endsection --}}
@extends('layouts.app')
@section('content')
 <div class="container">
      <h2>Edit Album</h2><br/>
      {{-- dd($artists) --}}
      {{ Form::model($album,['route' => ['album.update',$album->id],'method'=>'PUT']) }}
<div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Album Name:</label>
           {!! Form::text('album_name',$album->album_name,array('class' => 'form-control')) !!}
          </div>
        </div>
<div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Genre:</label>
           {!! Form::text('genre',$album->genre,array('class' => 'form-control')) !!}
          </div>
</div>
<div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="artist">Artist:</label>
              {!! Form::select('artist_id',$artists, $album->artist_id,['class' => 'form-control form-select']) !!}
            </div>
      </div>
 </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
     {!! Form::close() !!}
    </div>
@endsection