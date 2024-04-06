<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d-m-Y');
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d-m-Y');
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '';
                if (Gate::allows('update role')) {
                    $actionBtn .= '<button type="button" name="edit" data-id="' . $data->id . '" class="action btn btn-warning btn-sm me-2"><i class="ti-pencil-alt"></i></button>';
                }
                if (Gate::allows('delete role')) {
                    $actionBtn .= '<button type="button" name="delete" data-id="' . $data->id . '" class="action btn btn-danger btn-sm"><i class="ti-trash"></i></button>';
                }

                return '<div class="d-flex">' . $actionBtn . '</div>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->parameters(['searchDelay' => 1000])
            ->setTableId('role-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('id'),
            Column::make('DT_RowIndex')
                ->orderable(false)
                ->searchable(false)
                ->title('No')
                ->addClass('text-start'),
            Column::make('name'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
