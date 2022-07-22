<?php

namespace App\DataTables;

use App\Models\Album;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Dompdf\Dompdf ;

class AlbumsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $albums =  Album::with(['artist','listeners']);

        return datatables()
            ->eloquent($albums)
            // ->addColumn('action', 'albums.action');
            ->addColumn('action', function($row) {
                    return "<a href=". route('album.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('album.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" 
                    value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('listener', function (Album $albums) {
                    return $albums->listeners->map(function($listener) {
                        // return str_limit($listener->listener_name, 30, '...');
                        return "<li>".$listener->listener_name. "</li>";
                    })->implode('<br>');
                })
                 ->addColumn('artist', function (Album $albums) {
                    return $albums->artist->artist_name;
                })
            // ->rawColumns(['listener','action'])
            ->escapeColumns([]);
          }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Album $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Album $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('albums-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
       return [
            
            Column::make('id'),
            Column::make('album_name'),
            Column::make('genre'),
            Column::make('artist')->name('artist.artist_name')->title('artist name'),
            Column::make('listener')->name('listeners.listener_name')->title('listener name'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Albums_' . date('YmdHis');
    }
}
