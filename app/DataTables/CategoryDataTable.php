<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // return (new EloquentDataTable($query))
        //     ->addColumn('action', 'category.action')
        //     ->setRowId('id');


        return (new EloquentDataTable($query))
        ->editColumn('status', function ($row) {
                        $changeStatusUrl = route('category.status.toggle', $row['id']);
                        $changeStatusUrl = "'" . $changeStatusUrl . "'";
                        $tableName = "'categoryDataTable'";
                        $status = $row['status'] ? 'Active' : 'InActive';
                        $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                        return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
                    })
                    ->addColumn('image', function ($row) {
                        $image  = '';
                        $image .= '<img src="' . $row->category_image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
                        return $image;
                    })
                    ->addColumn('action', function ($row) {
                        $view_link = route('category.show', $row['id']);
                        $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';
        
                        $updateLink = route('category.edit', $row['id']);
                        $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';
        
                        $delete_link = route('category.delete', $row['id']);
                        $delete_link = "'" . $delete_link . "'";
                        $tableName = "'categoryDataTable'";
        
                        $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';
        
                        return $option;
                    })
                    ->rawColumns(['status', 'image', 'action']);






    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model): QueryBuilder
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
                    ->setTableId('category-table')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            // Column::computed('image'),
            Column::make('name'),
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
        return 'Category_' . date('YmdHis');
    }
}
