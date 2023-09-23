<?php

namespace App\DataTables;

use App\Models\Tag;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class TagDataTable extends DataTable
{
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->editColumn('checkbox', function ($row) {
             
            return '<input type="checkbox" class="checkall delete_check" value="'.$row['id'].'" >';
        })
      
        ->editColumn('status', function ($row) {
            $changeStatusUrl = route('tag.status.toggle', $row['id']);
            $changeStatusUrl = "'" . $changeStatusUrl . "'";
            $tableName = "'tag-table'";
            $status = $row['status'] ? 'Active' : 'InActive';
            $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
            return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
        })
        ->addColumn('action', function ($row) {
            $view_link = route('tag.show', $row['id']);
            $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';

            $updateLink = route('tag.edit', $row['id']);
            $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

            $delete_link = route('tag.delete', $row['id']);
            $delete_link = "'" . $delete_link . "'";
            $tableName = "'tag-table'";

            $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

            return $option;
        })
        ->rawColumns(['checkbox','status',  'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Tag $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tag $model): QueryBuilder
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
                    ->setTableId('tag-table')
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
            Column::make('checkbox')
            ->exportable(false)
            ->printable(false)
            ->title('<input type="checkbox" id="checkall">')
            ->addClass('text-center')
            ->width(30)
            ->orderable(false)
            ->searchable(false)
            ->data('checkbox', 'checkbox'),
            Column::make('id'),
            Column::make('name'),
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
        return 'Tag_' . date('YmdHis');
    }
}
