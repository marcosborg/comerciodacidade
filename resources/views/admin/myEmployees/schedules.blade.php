@extends('layouts.admin')
@section('content')

<script>
    console.log({!! $shop_schedules !!})
</script>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Horários
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th class="hide">

                                </th>
                                <th>
                                    Dia
                                </th>
                                <th>
                                    Hora
                                </th>
                                <th>
                                    Serviço
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop_schedules as $shop_schedule)
                            <tr>
                                <td class="hide">

                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($shop_schedule->start_time)->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($shop_schedule->start_time)->format('H:m') }} - {{
                                    \Carbon\Carbon::parse($shop_schedule->end_time)->format('H:m') }}
                                </td>
                                <td>
                                    {{ $shop_schedule->service->name }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info"
                                        href="/admin/my-employees/edit-schedule/{{ $shop_schedule->id }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <a class="btn btn-xs btn-danger"
                                        href="/admin/my-employees/delete-schedule/{{ $shop_schedule->id }}">
                                        {{ trans('global.delete') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                Criar marcação
            </div>
            <div class="card-body">
                <form action="{{ route("admin.shop-schedules.store") }}" method="POST">
                    @csrf
                    <input type="hidden" name="mySchedules" value="1">
                    <input type="hidden" name="service_employee_id" value="{{ $service_employee->id }}">
                    <div class="form-group">
                        <label>Início do serviço</label>
                        <input type="text" class="form-control datetime" name="start_time">
                    </div>
                    <div class="form-group">
                        <label>Fim do serviço</label>
                        <input type="text" class="form-control datetime" name="end_time">
                    </div>
                    <div class="form-group">
                        <label>Serviço</label>
                        <select name="service_id" class="form-control">
                            <option selected disabled>Selecionar</option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Criar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $('.datatable').DataTable();
</script>
@endsection