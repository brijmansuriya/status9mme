<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PostDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function ($row) {
                $image  = '';
                $image .= '<img src="' . $row->image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
                return $image;
            })

            ->editColumn('status', function ($row) {
                $changeStatusUrl = route('post.status.toggle', $row['id']);
                $changeStatusUrl = "'" . $changeStatusUrl . "'";
                $tableName = "'postsDataTable'";
                $status = $row['status'] ? 'Active' : 'InActive';
                $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
            })
            ->addColumn('action', function ($row) {

                $updateLink = route('post.edit', $row['id']);
                $option = '';

                $option .= '<a href="' . $updateLink . '" class="action-icon" data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                $delete_link = route('post.delete', $row['id']);
                $delete_link = "'" . $delete_link . "'";
                $tableName = "'postsDataTable'";

                $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

                return $option;
            })

            ->addColumn('generated_link', function ($row) {
                $link =  $row->generated_link;
                return '<a href="' . $link . '" class="btn btn-primary" data-overlaycolor="#38414a">View Link</a>';
            })
            ->orderColumn("updated_at", function ($query, $row) {
                return $query->orderBy("updated_at", $row);
            })
            ->rawColumns(['action', 'generated_link', 'status', 'image'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('post-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            // Column::computed('image'),
            Column::make('image'),
            Column::make('title'),
            Column::make('slug'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Post_' . date('YmdHis');
    }
}
