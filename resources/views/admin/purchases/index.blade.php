@extends('layouts.admin')
@section('content')
@can('purchase_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.purchases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.purchase.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.purchase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Purchase">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.relationship') }}
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
                            {{ trans('cruds.purchase.fields.cart') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.method') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.payed') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.internal') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase.fields.id_payment') }}
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
                            <td>

                            </td>
                            <td>
                                {{ $purchase->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Purchase::TYPE_RADIO[$purchase->type] ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->relationship ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->name ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->price ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->vat ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $purchase->status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $purchase->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $purchase->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->total ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->qty ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->cart ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->address ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->method ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $purchase->payed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $purchase->payed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $purchase->internal ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->id_payment ?? '' }}
                            </td>
                            <td>
                                {{ $purchase->created_at ?? '' }}
                            </td>
                            <td>
                                @can('purchase_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.purchases.show', $purchase->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('purchase_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.purchases.edit', $purchase->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('purchase_delete')
                                    <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('purchase_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.purchases.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Purchase:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection