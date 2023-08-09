<?php

namespace App\DataTables;

use App\Models\Subscription;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SubscriptionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $view = view('admin.subscriptions.datatables_actions', compact('row'));
                return $view->render();
            })
            ->rawColumns(['action'])
            ->addColumn('name', function($row){
                return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : 'Undefined';
            })
            ->addColumn('service', function($row){
                return $row->service ? $row->service->title : 'Undefined';
            })
            ->addColumn('count_used', function($row){
                return $row->count_used .  '/'. $row->count;
            })
            ->addColumn('is_active', function($row) {
                if ($row->is_active){
                    return trans('admin.Enabled');
                }else{
                    return trans('admin.Canceled');
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->toFormattedDateString(); // ->toDayDateTimeString()
            })
            ->addColumn('trial_ends_at', function($row){
                return $row->trial_ends_at->toFormattedDateString(); // ->toDayDateTimeString()
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscription $model)
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
                'title' => 'No.',
                'data' => 'DT_RowIndex',
                'orderable' => false,
                'searchable' => false,
            ],[
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.Name'),
            ],[
                'name' => 'service',
                'data' => 'service',
                'title' => trans('admin.Service'),
            ],[
                'name' => 'count_used',
                'data' => 'count_used',
                'title' => trans('admin.count_used'),
            ],[
                'name' => 'is_active',
                'data' => 'is_active',
                'title' => trans('admin.Is_Active'),
            ],[
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('admin.Created_At'),
            ],[
                'name' => 'trial_ends_at',
                'data' => 'trial_ends_at',
                'title' => trans('admin.trial_ends_at'),
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
        return 'subscriptions_datatable_' . time();
    }
}
