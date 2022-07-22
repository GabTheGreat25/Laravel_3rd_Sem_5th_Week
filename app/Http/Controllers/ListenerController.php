<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Redirect;
use App\DataTables\ListenersDataTable;
use App\Models\Album;
use App\Models\Listener;

class ListenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->get('search'))) 
        {
        $listeners = Listener::with('albums')->get();       
        }
        else 
        {
            $listeners = Listener::with(['albums' =>function($q) use($request)
            {
            $q->where("album_name","LIKE", "%".$request->get('search')."%");}])->get();
        }
    $url = 'listener';
    return View::make('listener.index',compact('listeners','url'));

    // if(empty($request->get('search'))){
    //     $listeners = Listener::with('albums')->get();
    //     dd($listeners);
    //     return $listeners->albums->map(function($album){
    //         dump($album);
    //         });
    //     }
    //     else{

    //     }
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::with('artist')->get();
        // dd($album);
        // foreach($albums as $album ) {
        //     dump($album->artist->artist_name);
        // }
        return View::make('listener.create',compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $input = $request->all();
    // dd($request->album_id);
    $listener = Listener::create($input);
    if(empty($request->album_id)){
    foreach ($request->album_id as $album_id) {
        // DB::table('album_listener')->insert(
        //     ['album_id' => $album_id, 
        //      'listener_id' => $listener->id]
        //     );
        // dd($listener->albums());
        $listener->albums()->attach($album_id);
    }  //end foreach

}
return Redirect::to('listener')->with('success','New listener added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listener_albums = array();
        $listener = Listener::with('albums')->where('id', $id)->first();
        if(!(empty($listener->albums))){
            foreach($listener->albums as $listener_album){
                $listener_albums[$listener_album->id] = $listener_album->album_name;
            }
        }

        $albums = Album::pluck('album_name','id')->toArray();
        return View::make('listener.edit',compact('albums','listener','listener_albums'));
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
    $listener = Listener::find($id);
    $album_ids = $request->input('album_id');
    $listener->albums()->sync($album_ids);
    $listener->update($request->all());
    return Redirect::route('listener.index')->with('success','lister updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Listener = Listener::find($id);
        $Listener->albums()->detach();
        $Listener->delete(); 
        return Redirect::route('getListeners')->with('success','Listener deleted!');
    }

    public function getListeners(ListenersDataTable $dataTable)
    {
        $albums = Album::with('artist')->get();
        return $dataTable->render('listener.listener', compact('albums'));
    }
}
