<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AdminsDataTable extends DataTable
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
            ->addIndexColumn()
            ->addColumn('Aksi', function ($query) {
                return view('pages.User.action', compact('query'));
            })
            ->editColumn('email', function ($query) {
                $isColor = !$query->deleted_at ? 'green' : 'red';
                $isIcon = !$query->deleted_at ? 'checkmark-circle' : 'close-circle';
                return "<td>" . $query->email . "<ion-icon name='" . $isIcon . "' style='color:" . $isColor . "' ></ion-icon>
            </td>";
            })

            ->rawColumns([ 'email'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->withWhereHas('roles', function ($roles) {
            return $roles->where('name', 'admin');
        })->withTrashed()->where(function ($query) {
            return  $query->whereDate('deleted_at', '>', Carbon::now()->subMonth())->orWhereNull('deleted_at');
        })->whereNot('id', auth()->user()->id)->latest('created_at')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()

            // ->dom('PBfrtip')
            ->orderBy(1)
            // ->selectStyleSingle()
            ->parameters([
                "dom" => 'l<"top"<"left-col"B><"right-col"f>>rtip',
                'responsive' => true,
                'scrollX' => true,
                'autoWidth' => false
            ])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                // Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
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
            Column::make('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->orderable(false),
            Column::make('email'),
            Column::make('name')
                ->title('Nama'),
            Column::computed('Aksi')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->searchPanes(false)
                ->width(60)
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
        return 'Users_' . date('YmdHis');
    }
}
