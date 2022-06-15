@extends('layouts.base')
@section('body')
    <div class="container">
      <h2>updateArtist</h2><br/>
      {{ Form::model($artist,['method'=>'PUT','route' => ['artist.update',$artist->id]]) }}
<div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Artist Name:</label>
             {!! Form::text('artist_name',$artist->artist_name,array('class' => 'form-control')) !!}
          </div>
        </div>
  </div>
</div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
@endsection
