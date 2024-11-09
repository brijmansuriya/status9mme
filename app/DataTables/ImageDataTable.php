<?php

namespace App\DataTables;

use App\Models\Image;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ImageDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $image  = '';
                $image .= '<a href="' . $row->image . '" target="_blank"><img src="' . $row->image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> </a>';
                return $image;
            })
            ->editColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="checkall delete_check" value="' . $row['id'] . '" >';
            })

            ->editColumn('status', function ($row) {
                $changeStatusUrl = route('image.status.toggle', $row['id']);
                $changeStatusUrl = "'" . $changeStatusUrl . "'";
                $tableName = "'image-table'";
                $status = $row['status'] ? 'Active' : 'InActive';
                $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
            })
            ->addColumn('action', function ($row) {
                $view_link = route('image.show', $row['id']);
                $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';

                $updateLink = route('image.edit', $row['id']);
                $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                $delete_link = route('image.delete', $row['id']);
                $delete_link = "'" . $delete_link . "'";
                $tableName = "'image-table'";

                $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';


                return $option;
            })
            ->rawColumns(['checkbox', 'status', 'image',  'action']);
    }

   
    public function query(Image $model): QueryBuilder
    {
        return $model->newQuery();
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('image-table')
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
            Column::make('image'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

   
    protected function filename(): string
    {
        return 'image_' . date('YmdHis');
    }
}