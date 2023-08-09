<?php

namespace App\DataTables;

use App\Helpers\HelpersFun;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
//        $dataTable = new EloquentDataTable($query);
//
//        return $dataTable->addColumn('action', 'admin.users.datatables_actions');

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', 'admin.users.datatables_actions')
            ->addColumn('avatar', 'admin.users.avatar')
            ->rawColumns(['action', 'avatar'])
            ->addColumn('is_active', function($row){
                return HelpersFun::isTrue($row->is_read);
            })
            ->addColumn('name', function($row){
                return $row->first_name . ' ' . $row->last_name;
            })
            ->addColumn('created_at', function($row){
//                return $row->getCreatedAt(); // ->toDayDateTimeString()
                return $row->created_at->toFormattedDateString(); // ->toDayDateTimeString()
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->orderBy('created_at', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            // ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'lBfrtip',
                'stateSave' => false,
                'order-service'     => [[0, 'desc']],
                'buttons'   => [
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],

                'ordering'=> true,
                'responsive' => true,
                'lengthChange'=> true,
                'autoWidth' => false,
                'language' => [
                    'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/' . trans('admin.' . app()->getLocale().'-file') . '.json'),
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'id',
//                'data' => 'id', // DT_RowIndex
                'title' => 'No.',
                'data' => 'DT_RowIndex',
                'orderable' => false,
                'searchable' => false,
            ],[
                'name' => 'avatar',
                'data' => 'avatar',
                'title' => trans('admin.Avatar'),
            ],[
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.Name'),
            ],[
                'name' => 'email',
                'data' => 'email',
                'title' => trans('admin.Email'),
            ],[
                'name' => 'is_active',
                'data' => 'is_active',
                'title' => trans('admin.Is_Active'),
            ],[
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('admin.Created_At'),
            ],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
