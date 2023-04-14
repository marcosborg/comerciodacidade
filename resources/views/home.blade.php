@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Plano de pagamentos
                </div>

                <div class="card-body">
                    <p><b>Logado como: </b>{{ auth()->user()->email }}</p>
                    <p><b>Plano atual: </b>{{ $user->subscription->subscription_type->plan->name }}</p>
                    @if ($user->subscription->subscriptionPayments->count() > 0)
                    <p><b>Última renovação: </b>{{ $user->subscription->start_date }}</p>
                    <p><b>Proxima renovação: </b>{{ $user->subscription->end_date }}</p>
                    <hr>
                    @endif
                    <p>
                        <button class="btn btn-primary" id="btn-pay" type="button" data-toggle="collapse"
                            data-target="#collapsePayment" aria-expanded="false">
                            Pagar plano atual
                        </button>
                    </p>
                    <div class="collapse" id="collapsePayment">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($plans as $key => $plan)
                            <li class="nav-item">
                                <a class="nav-link 
                                @if ($user->subscription)
                                {{ $user->subscription->subscription_type->plan_id == $plan->id ? 'active' : '' }}
                                @else
                                {{ $key == 0 ? 'active' : '' }}
                                @endif
                                " data-toggle="tab" href="#tab-{{ $plan->id }}" role="tab">{{
                                    $plan->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($plans as $key => $plan)
                            <div class="tab-pane fade 
                            @if ($user->subscription)
                            {{ $user->subscription->subscription_type->plan_id == $plan->id ? 'show active' : '' }}
                            @else
                            {{ $key == 0 ? 'show active' : '' }}
                            @endif
                            " id="tab-{{ $plan->id }}" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($plan->subscriptionTypes as $key => $subscriptionType)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subscription_type"
                                                id="subscription_type_{{ $subscriptionType->id }}"
                                                value="{{ $subscriptionType->id }}" {{ $key==0 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="subscription_type_{{ $subscriptionType->id }}">
                                                {{ $subscriptionType->months }} meses com {{
                                                $subscriptionType->discount
                                                }}% de
                                                desconto
                                            </label>
                                        </div>
                                        @endforeach
                                        <hr>

                                        <button onclick="payment('mb')" type="button" class="btn btn-light"><img
                                                src="/theme/assets/img/payment/mb-logo.png" alt="mb-logo"></button>
                                        <button onclick="payment('mbway')" type="button" class="btn btn-light"><img
                                                src="/theme/assets/img/payment/mbway-logo.png"
                                                alt="mbway-logo"></button>
                                        <button onclick="payment('cards')" type="button" class="btn btn-light"><img
                                                src="/theme/assets/img/payment/visa-e-mastercard.png"
                                                alt="visa-e-mastercard"></button>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <h1 class="float-right total">€ <span id="total">0.00</span><span class="small">+ IVA</span></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Pagamentos
                </div>

                <div class="card-body">
                    @if ($user->subscription && $user->subscription->subscriptionPayments)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Plano</th>
                                <th>Método</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->subscription->subscriptionPayments as $subscriptionPayment)
                            <tr>
                                <td>{{ $subscriptionPayment->created_at }}</td>
                                <td>€ {{ $subscriptionPayment->value }}</td>
                                <td>{{ $subscriptionPayment->subscription->subscription_type->plan->name }}</td>
                                <td>{{ $subscriptionPayment->method }}</td>
                                <td>{!! $subscriptionPayment->paid == 1 ? '<span
                                        class="badge badge-success">Pago</span>' : '<span
                                        class="badge badge-danger">Aguarda pagamento</span>' !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-primary" role="alert">
                        Ainda não existem pagamentos.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="amount">
<div class="modal fade" id="payment-modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="inner-payment"></div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    a.nav-link {
        color: #ccc;
    }

    span.small {
        font-size: 20px;
    }

    .total {
        display: none;
    }
</style>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(() => {
        $('#collapsePayment').on('shown.bs.collapse', function() {
            $('#btn-pay').hide();
            $('.total').show();
            getSubscriptionType();
        });

        $('#payment-modal').on('hidden.bs.modal', function() {
            location.reload();
        });

        $('input[type=radio][name=subscription_type]').change(() => {
            getSubscriptionType();
        });
    });

    getSubscriptionType = () => {
        let subscription_type_id = $('input[type=radio][name=subscription_type]:checked').val();
        $.get('/admin/subscription-type/' + subscription_type_id).then((resp) => {
            let subscriptionType = resp;
            let totalWithoutDiscount = subscriptionType.months * subscriptionType.plan.price;
            let discount = subscriptionType.discount;
            let totalWithDiscount = (totalWithoutDiscount * discount) / 100;
            let total = totalWithoutDiscount - totalWithDiscount;
            $('#total').text(total.toFixed(2));
            $('input[name=amount]').val(total.toFixed(2));
        });
    }

    payment = (type) => {
        $.LoadingOverlay('show');
        let method = '';
        if(type == 'mb'){
            method = 'Multibanco';
        } else if(type == 'mbway'){
            method = 'MBWAY';
        } else {
            method = 'Cartão';
        }
        let amount = ($('input[name=amount]').val()*1.23).toFixed(2);
        var form = new FormData();
        form.append("subscription_id", {{ $user->subscription->id }});
        form.append("value", amount);
        form.append("method", method);
        form.append("paid", "0");
        var settings = {
            "url": "/payments/subscriptionPaymentGenerate",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };
        $.ajax(settings).done(function (resp) {
            let subscriptionPayment = JSON.parse(resp);
            if(type == 'mb'){
                $.get('payments/mb/' + subscriptionPayment.id + '/' + amount).then((resp) => {
                    $.LoadingOverlay('hide');
                    $('#inner-payment').html(resp);
                });
            } else if(type == 'mbway') {
                $.get('payments/mbway/' + subscriptionPayment.id + '/' + amount).then((resp) => {
                    $.LoadingOverlay('hide');
                    $('#inner-payment').html(resp);
                });
            } else {

            }
        });
        $('#payment-modal').modal('show');
    }

    sendMbByEmail = () => {
        $.LoadingOverlay('show');
        let body = $('#inner-payment .modal-body').html();
        let data = {
            body: body,
        }
        $.ajax({
            url: '/payments/sendMbByEmail',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $.LoadingOverlay('hide');
                Swal.fire(
                    'Sucesso!',
                    'Enviamos os dados de pagamento para o seu email!',
                    'success'
                ).then(() => {
                    $('#payment-modal').modal('hide');
                });
            },
            error: function(error) {
                $.LoadingOverlay('hide');
                $('#payment-modal').modal('hide');
            }
        });
    }
</script>
@endsection