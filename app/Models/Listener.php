<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Listener extends Model implements Searchable
{
    use HasFactory;
    protected $fillable = ['listener_name'];

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

     public function getSearchResult(): SearchResult
     {
        $url = url('show-listener/'.$this->id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->listener_name,
            $url
            );
     }

}
