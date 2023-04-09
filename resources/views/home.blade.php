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
                    <p><b>Última renovação: </b>{{ $user->subscription->start_date }}</p>
                    <p><b>Proxima renovação: </b>{{ $user->subscription->end_date }}</p>
                    <p>
                        <button class="btn btn-primary" id="btn-renew" type="button" data-toggle="collapse"
                            data-target="#collapsePayment" aria-expanded="false">
                            Renovar
                        </button>
                    </p>
                    <div class="collapse" id="collapsePayment">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($plans as $plan)
                            <li class="nav-item">
                                <a class="nav-link {{ $user->subscription->subscription_type->plan_id == $plan->id ? 'active' : '' }}"
                                    data-toggle="tab" href="#tab-{{ $plan->id }}" role="tab">{{
                                    $plan->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($plans as $plan)
                            <div class="tab-pane fade {{ $user->subscription->subscription_type->plan_id == $plan->id ? 'show active' : '' }}"
                                id="tab-{{ $plan->id }}" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @foreach ($plan->subscriptionTypes as $subscriptionType)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="subscription_type" value="{{ $subscriptionType->id }}"
                                                        checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        {{ $subscriptionType->months }} meses com {{
                                                        $subscriptionType->discount
                                                        }}% de
                                                        desconto
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="float-right">€ 100.00<span class="small">+ IVA</span></h1>
                                            </div>
                                        </div>
                                        <button class="btn btn-success mt-4">Renovar</button>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Plano</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2022-08-09</td>
                                <td>€10.49</td>
                                <td>Monthly Plan</td>
                            </tr>
                        </tbody>
                    </table>
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
        $('#collapsePayment').on('shown.bs.collapse', function () {
            $('#btn-renew').hide();
        })
    });
    console.log({!! $plans !!});
    console.log({!! $user !!});
</script>
@endsection