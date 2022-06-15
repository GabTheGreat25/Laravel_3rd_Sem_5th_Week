<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class artist extends Model implements Searchable
{

    use HasFactory;
    protected $fillable = ['artist_name','img_path'];
    // protected $guarded = ['id'];
    public $searchableType = 'Artist Searched';


    public function albums()
    {
        return $this->hasMany('App\Models\Album');
    }


    public function getSearchResult(): SearchResult
    {
        $url = url('show-artist/' . $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->artist_name,
            $url
        );
    }
}