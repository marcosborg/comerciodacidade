@extends('layouts.admin')
@section('content')
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<style>
    .list-group-item-action {
      cursor: pointer;
    }
    .fc-title {
        color: #fff;
    }
  </style>
@endsection
<h3 class="text-center">Agenda de {{ $service_employee->name }}</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tab1" data-toggle="tab" data-target="#tab-content-1" type="button"
            role="tab" aria-controls="tab1" aria-selected="true">Calendário</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab2" data-toggle="tab" data-target="#tab-content-2" type="button" role="tab"
            aria-controls="tab2" aria-selected="false">Marcações</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab-content-1" role="tabpanel" aria-labelledby="tab-content-1">
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Calendário
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Para hoje
                    </div>
                    <div class="card-body">
                        @if ($today_shop_schedules->count() == 0)
                        <div class="alert alert-info" role="alert">Não tem marcações para hoje</div>
                        @endif
                        <ul class="list-group">
                            @foreach ($today_shop_schedules as $today_shop_schedule)
                            <li class="list-group-item list-group-item-action" onclick="editSchedule({{ $today_shop_schedule->id }})">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $today_shop_schedule->client }}</h5>
                                    <small>{{ \Carbon\Carbon::parse($today_shop_schedule->start_time)->format('H:i') }}
                                        - {{
                                        \Carbon\Carbon::parse($today_shop_schedule->end_time)->format('H:i') }}</small>
                                </div>
                                <p class="mb-1">{{ $today_shop_schedule->service->name }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-content-2" role="tabpanel" aria-labelledby="tab-content-2">
        <div class="row mt-4">
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
                                            {{ \Carbon\Carbon::parse($shop_schedule->start_time)->format('H:i') }} - {{
                                            \Carbon\Carbon::parse($shop_schedule->end_time)->format('H:i') }}
                                        </td>
                                        <td>
                                            {{ $shop_schedule->service->name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-info"
                                                onclick="editSchedule({{ $shop_schedule->id }})">Editar</button>
                                            <a class="btn btn-xs btn-danger"
                                                href="/admin/my-employees/delete-schedule/{{ $shop_schedule->id }}"
                                                onclick="return confirm('{{ trans('global.areYouSure') }}');">
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
                                <label>Cliente</label>
                                <input type="text" class="form-control" name="client">
                            </div>
                            <div class="form-group">
                                <label>Início do serviço</label>
                                <input type="text" class="form-control datetime" name="start_time">
                            </div>
                            <input type="hidden" name="end_time" value="">
                            <div class="form-group">
                                <label>Serviço</label>
                                <select name="service_id" class="form-control">
                                    <option selected disabled>Selecionar</option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} - {{
                                        $service->service_duration->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editSchedule" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Marcação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route("admin.shop-schedules.update", [1]) }}" method="POST">
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="mySchedules" value="1">
                    <input type="hidden" name="service_employee_id" value="{{ $service_employee->id }}">
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" class="form-control" name="client">
                    </div>
                    <div class="form-group">
                        <label>Início do serviço</label>
                        <input type="text" class="form-control datetime" name="start_time">
                    </div>
                    <div class="form-group">
                        <label>Fim do serviço</label>
                        <input type="text" class="form-control datetime" name="end_time">
                    </div>
                    <div class="form-group">
                        <label class="required" for="service_id">{{ trans('cruds.shopSchedule.fields.service')
                            }}</label>
                        <select class="form-control" name="service_id" required>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<script>
    $(()=>{
        $('.datatable').DataTable();
        $('#editSchedule form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                location.reload();
            }
        });
        $('#tab2').on('shown.bs.tab', function() {
            $('.datatable').DataTable().destroy();
            $('.datatable').DataTable();
        });
    });
    editSchedule = (id) => {
        $.LoadingOverlay('show');
        $.get('/admin/my-employees/get-schedule/' + id).then((resp) => {
            $.LoadingOverlay('hide');
            $('#editSchedule input[name=client]').val(resp.client);
            $('#editSchedule input[name=start_time]').val(resp.start_time);
            $('#editSchedule input[name=end_time]').val(resp.end_time);
            $('#editSchedule select[name=service_id]').val(resp.service_id);
            $('#editSchedule').modal('show');
        });
    }
</script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,
                eventClick: function(calEvent, jsEvent, view) {
                    editSchedule(calEvent.id);
                },
                timeFormat: 'HH:mm'
            })
        });
</script>
@endsection