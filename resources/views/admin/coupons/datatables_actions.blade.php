{!! Form::open(['route' => ['Admin::coupons.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('Admin::coupons.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('Admin::coupons.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm(". trans('admin.Are_you_sure') .")"
    ]) !!}
</div>
{!! Form::close() !!}
