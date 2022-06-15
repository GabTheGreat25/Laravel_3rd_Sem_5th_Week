{{-- {{dd($albums)}}  --}}

@extends('layouts.app')
@section('content')
<div class="container">
       <a href="{{route('album.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD</strong></span>            
    </a>
</div>
@if ($message = Session::get('success'))
 <div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button> 
         <strong>{{ $message }}</strong>
 </div>
@endif
@include('partials.search')
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Album ID</th>
        <th>Title</th>
        <th>Album Cover</th>
        <th>Artist</th>
        <th>Genre</th>
        <th>Listeners</th>
        <th>Action</th> 
     </tr>
    </thead>
    <tbody>
      {{-- @foreach($albums as $album)
      <tr>
    <td>{{$album->id}}</td>
 
    <td>
      <img src="{{ asset($album->img_path)}}" alt="I am A Pic" width="75" height="75">
    </td>
          <td>{{$album->album_name}}</td>
          <td>{{$album->artist_name}}</td> --}}
          @foreach($albums as $album)
          <tr>
            <td>{{$album->id}}</td>
            <td>{{$album->album_name}}</td>
            <td><img src="{{ asset($album->img_path) }}" /></td>
            <td>{{$album->artist->artist_name}}</td>
            <td>{{$album->genre}}</td>
            <td>
              @foreach($album->listeners as $listener)
                <li>{{$listener->listener_name}}</li> 
              @endforeach
            </td>
          <td><a href="{{ action('AlbumController@edit', $album->id)}}" class="btn btn-warning">Edit</a></td>
            <td>
              <form action="{{ action('AlbumController@destroy', $album->id)}}" method="post">
               {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
      </tbody>
      </table>
    
      </div>
    @endsection
 