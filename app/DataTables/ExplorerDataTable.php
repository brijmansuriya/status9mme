<?php

namespace App\DataTables;

use App\Models\Categorie;
use App\Models\Explorer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ExplorerDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="checkall delete_check" value="' . $row['id'] . '" >';
            })
            // ->editColumn('status', function ($row) {
            //     $changeStatusUrl = route('category.status.toggle', $row['id']);
            //     $changeStatusUrl = "'" . $changeStatusUrl . "'";
            //     $tableName = "'CategorieDataTable'";
            //     $status = $row['status'] ? 'Active' : 'InActive';
            //     $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
            //     return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
            // })

            ->addColumn('action', function ($row) {
                $view_link = route('explorer.show', $row['id']);
                $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';

                $updateLink = route('explorer.edit', $row['id']);
                $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                $delete_link = route('explorer.delete', $row['id']);
                $delete_link = "'" . $delete_link . "'";
                $tableName = "'explorer-table'";

                $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

                return $option;
            })
            ->rawColumns(['checkbox', 'status', 'image', 'action']);
    }

    public function query(Explorer $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('explorer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy([1])
            ->selectStyleSingle()
            ->buttons([
                Button::make(['excel']),
                Button::make(['csv']),
                Button::make(['pdf']),
                Button::make(['print']),
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
            Column::make('title'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
