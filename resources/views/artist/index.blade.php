@extends('layouts.app')
@section('content')
<div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
     @include('partials.search')
    <table class="table table-striped">
      <tr>{{ link_to_route('artist.create', 'Add new artist:')}}</tr>
<thead>
      <tr>
        <th>Artist ID</th>
        <th>Artist Image</th>
        <th>Artist Name</th>    
        <th>Album Name</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
 <tbody> 
@foreach($artists as $artist)     
      <tr>
        <td>{{$artist->id}}</td>
        <td><img src="{{ asset($artist->img_path) }}" /></td>
        <td>{{$artist->artist_name}}</td>
        <td>
        @foreach($artist->albums as $album)
          <li>{{$album->album_name}} </li>  
        @endforeach
        </td>
        <td>
        <form action="{{ action('ArtistController@destroy', $artist->id)}}" method="post">
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
