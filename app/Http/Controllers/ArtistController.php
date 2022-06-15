<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use App\Models\Artist;
use App\Models\Album;
use Laravel\Ui\Presets\React;
use App\DataTables\ArtistsDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Log;
class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (empty($request->get('search'))) {
            $artists = Artist::with('albums')->get();
            // $artists = Artist::has('albums')->get();
            //ifefetech yung may related album

            // dd($artists);
        } else
            $artists = Artist::with(['albums' => function ($q) use ($request) {
                $q->where("genre", "=", $request->get('search'))
                    // ! titignan muna kaya naka array if existing yung genre pag wala hindi na agad lalabas
                    ->orWhere("album_name", "LIKE", "%" . $request->get('search') . "%");
                // ? or kung anu man nilagay mo na may genre
            }])->where("artist_name", "LIKE", "%" . $request->get('search') . "%")
                ->get();

        $url = 'artist';
        return View::make('artist.index', compact('artists', 'url'));
    }
    
    public function create()
    {
        return View::make('artist.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        Artist::create($input);

        return Redirect::to('artists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::find($id);
        // dd($artist);
        return view('artist.show',compact('artist'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
    {
        $artist = Artist::find($id);
        // dd($artist);
        return View::make('artist.edit',compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function update(Request $request, $id)
    {
       $artist = Artist::find($id);
        // $album->artist_id = $request->artist_id;
        $artist->artist_name = $request->artist_name;
        $artist->save();
        return Redirect::to('/artists')->with('success','Artist updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Artist::find($id);
        // Album::where('artist_id',$artist->id)->delete();
        // $artist->albums()->delete();
        $artist->delete();
        // $artists = Artist::with('albums')->get();
        return Redirect::to('/artists');
    }
    public function getArtists(Builder $builder) {
        // dd($dataTable);
        //return $dataTable->render('artist.artist');
        // dd($dataTable);
        // return $dataTable->render('artist.artists');
        // dd(Artist::orderBy('artist_name', 'DESC')->get());
        // $artists = Artist::orderBy('artist_name', 'DESC')->get();
        // dd($artists);
        $artists = Artist::query();
        // dd($artists);
        if (request()->ajax()) {
        // return DataTables::of($artists)
        //                     ->toJson();
            // return DataTables::of($artists)->order(function ($query) {
            //          $query->orderBy('created_at', 'DESC');
            //      })->toJson();
                        // ->make();
            return DataTables::of($artists)
                     //    ->order(function ($query) {
                     // $query->orderBy('artist_name', 'DESC');
                     // })
             ->addColumn('action', function($row) {
            return "<a href=". route('artist.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
        <form action=". route('artist.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
              })
//             ->rawColumns(['action'])
            //             // ->make(true);
                      ->toJson();
        }

 $html = $builder->columns([
                ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                ['data' => 'artist_name', 'name' => 'artist_name', 'title' => 'Name'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At','searchable' => false, 'orderable' => false],

 ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'searchable' => false, 'orderable' => false, 'exportable' => false],
  // ['data' => 'action', 'name' => 'action', 'title' => 'Action']
            ]);

     return view('artist.artist', compact('html'));
    }

}
     
