@extends('layouts.admin')
@section('content')
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
@endsection
<h3 class="text-center">Agenda de {{ $service_employee->name }}</h3>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Calendário
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
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
                        <label>Início do serviço</label>
                        <input type="text" class="form-control datetime" name="start_time">
                    </div>
                    <div class="form-group">
                        <label>Fim do serviço</label>
                        <input type="text" class="form-control datetime" name="end_time">
                    </div>
                    <script>
                        console.log({!! $services !!})
                    </script>
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
    });
    editSchedule = (id) => {
        $.LoadingOverlay('show');
        $.get('/admin/my-employees/get-schedule/' + id).then((resp) => {
            $.LoadingOverlay('hide');
            console.log(resp);
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


            })
        });
</script>
@endsection