<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OrderDataTable extends DataTable
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
            ->addColumn('action', 'admin.orders.datatables_actions')
            ->addColumn('status', 'admin.orders.status')
            ->rawColumns(['action', 'status'])
            ->addColumn('name', function($row){
                return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : 'Undefined';
            })
            ->addColumn('service', function($row){
                return $row->service ? $row->service->title : 'Undefined';
            })
            ->addColumn('total', function($row){

                if ($row->total > 0){
                    return '$'.$row->total;
                }elseif(empty($row->subscription_id)){
                    return trans('admin.Use_of_Free');
                }else{
                    return trans('admin.Use_of_subscription');
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->toFormattedDateString(); // ->toDayDateTimeString()
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
                'name' => 'order_number',
                'data' => 'order_number',
                'title' => trans('admin.Order_Number'),
            ],[
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.Name'),
            ],[
                'name' => 'service',
                'data' => 'service',
                'title' => trans('admin.Service'),
            ],[
                'name' => 'service_title',
                'data' => 'service_title',
                'title' => trans('admin.Service_Title'),
            ],[
                'name' => 'total',
                'data' => 'total',
                'title' => trans('admin.Total'),
            ],[
                'name' => 'status',
                'data' => 'status',
                'title' => trans('admin.Status'),
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
        return 'orders_datatable_' . time();
    }
}
