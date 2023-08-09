<?php

namespace App\DataTables;

use App\Helpers\HelpersFun;
use App\Models\Contact;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ContactDataTable extends DataTable
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
            ->addColumn('action', 'admin.contacts.datatables_actions')
            ->rawColumns(['action'])
            ->addColumn('is_read', function($row){
                return HelpersFun::isTrue($row->is_read);
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->toFormattedDateString(); // ->toDayDateTimeString()
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
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
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.Name'),
            ],[
                'name' => 'subject',
                'data' => 'subject',
                'title' => trans('admin.Subject'),
            ],[
                'name' => 'is_read',
                'data' => 'is_read',
                'title' => trans('admin.Is_Read'),
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
        return 'contacts_datatable_' . time();
    }
}
