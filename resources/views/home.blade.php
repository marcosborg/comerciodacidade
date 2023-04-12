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
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->subscription->subscriptionPayments as $subscriptionPayment)
                            <tr>
                                <td>{{ $subscriptionPayment->created_at }}</td>
                                <td>€ {{ $subscriptionPayment->value }}</td>
                                <td>{{ $subscriptionPayment->subscription->subscription_type->plan->name }}</td>
                                <td>{!! $subscriptionPayment->paid == 1 ? '<span
                                        class="badge badge-success">Pago</span>' : '' !!}</td>
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
<div class="modal fade" id="payment-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Enviar dados por email</button>
            </div>
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
<script>
    $(() => {
        $('#collapsePayment').on('shown.bs.collapse', function() {
            $('#btn-pay').hide();
            $('.total').show();
            getSubscriptionType();
        })

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
        });
    }

    payment = (type) => {
        if(type == 'mb'){
            var settings = {
                "url": "https://ifthenpay.com/api/multibanco/reference/sandbox",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": JSON.stringify({
                    "mbKey": "YBN-625144",
                    "orderId": 1,
                    "amount": 20.3
                }),
                };

            $.ajax(settings).done(function (response) {
                console.log(response);
            });
        }
        $('#payment-modal').modal('show');
        console.log(type);
    }
</script>
@endsection