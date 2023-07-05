@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.myOrder.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Purchase">
                <thead>
                    <tr>
                        <th class="hide">

                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.vat') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.total') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.qty') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $key => $purchase)
                    <tr data-entry-id="{{ $purchase->id }}">
                        <td class="hide">

                        </td>
                        <td>
                            {{ $purchase->name ?? '' }}
                        </td>
                        <td>
                            € {{ $purchase->price ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->vat ?? '' }}%
                        </td>
                        <td>
                            <span style="display:none">{{ $purchase->status ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $purchase->status ? 'checked' : '' }}>
                        </td>
                        <td>
                            {{ $purchase->user->name ?? '' }}
                        </td>
                        <td>
                            € {{ $purchase->total ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->qty ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->created_at ?? '' }}
                        </td>
                        <td>
                            @can('my_order_access')
                            <a class="btn btn-xs btn-info" href="/admin/my-orders/edit/{{ $purchase->id }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 8, 'desc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-Purchase:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>
@endsection