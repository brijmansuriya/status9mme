<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AdminDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('image', function ($row) {
                $image  = '';
                $image .= '<img src="' . $row->profile_picture  . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
                return new HtmlString($image);
            })
            ->addColumn('action', function ($row) {

                $updateLink = route('admin.edit', $row['id']);
                $option = '';
                $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';
                if (Auth::user()->id != $row['id']) {
                    $delete_link = route('admin.delete', $row['id']);
                    $delete_link = "'" . $delete_link . "'";
                    $tableName = "'adminDataTable'";
                    $option .= '<a href="#" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" " ><i class="mdi mdi-delete"></i></a>';
                }

                return $option;
            })
            ->orderColumn("created_at", function ($query, $row) {
                return $query->orderBy("created_at", $row);
            })
            ->setRowId('id');
    }

    public function query(Admin $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('admin-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy([1])
            ->selectStyleSingle()
            ->buttons([
                Button::make(['excel','csv','pdf','print']),
                // Button::make(['csv']),
                // Button::make(['pdf']),
                // // Button::make('reset'),
                // Button::make(['print']),
                // // Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('image')->width(60),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
