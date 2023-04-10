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
                    <p><b>Plano atual: </b>{{ $user->subscription ? $user->subscription->subscription_type->plan->name : 'Ainda não fez nenhuma subscrição' }}</p>
                    <p><b>Última renovação: </b>{{ $user->subscription ? $user->subscription->start_date : 'Ainda não fez nenhuma subscrição' }}</p>
                    <p><b>Proxima renovação: </b>{{ $user->subscription ? $user->subscription->end_date : 'Ainda não fez nenhuma subscrição' }}</p>
                    <p>
                        <button class="btn btn-primary" id="btn-renew" type="button" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false">
                            Renovar
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                @foreach ($plan->subscriptionTypes as $key => $subscriptionType)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="subscription_type" id="subscription_type_{{ $subscriptionType->id }}" value="{{ $subscriptionType->id }}" {{ $key==0 ? 'checked' : ''
                                                        }}>
                                                    <label class="form-check-label" for="subscription_type_{{ $subscriptionType->id }}">
                                                        {{ $subscriptionType->months }} meses com {{
                                                        $subscriptionType->discount
                                                        }}% de
                                                        desconto
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="float-right">€ <span id="price">0.00</span><span class="small">+ IVA</span></h1>
                                            </div>
                                        </div>
                                        <button class="btn btn-success mt-4" onclick="payByLink()">Renovar</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
                                <td>{!! $subscriptionPayment->paid == 1 ? '<span class="badge badge-success">Pago</span>' : '' !!}</td>
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
@endsection
@section('styles')
<style>
    a.nav-link {
        color: #ccc;
    }

    span.small {
        font-size: 20px;
    }
</style>
@endsection
@section('scripts')
@parent
<script>
    $(() => {
        $('#collapsePayment').on('shown.bs.collapse', function() {
            $('#btn-renew').hide();
        })

        getSubscriptionType();

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
            console.log({
                totalWithoutDiscount: totalWithoutDiscount,
                discount: discount,
                totalWithDiscount: totalWithDiscount,
                total: total,
            });
            $('#total').html('total');
        });
    }

    payByLink = () => {
        var settings = {
            "url": "https://ifthenpay.com/api/gateway/paybylink/get?gatewaykey=BMBR-650534&id=1000&amount=2",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "Cookie": "ARRAffinity=cc3c6651acdd3282d60a76036929f0b096836d3038b01b137cfbdaf09c0a1429; ASP.NET_SessionId=elrpt2qsz5hbmcs1ipvs4n0k"
            },
        };
        $.ajax(settings).done(function(response) {
            console.log(response);
            window.open(response, '_blank', 'width=500,height=500');
        });
    }

    console.log({
        !!$plans!!
    })
</script>
@endsection