@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.paymentMethod.title') }}
    </div>
    <form action="/admin/payment-methods/update" method="post">
        @csrf
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <div class="card-body">
            <div class="alert alert-info" role="alert">
                <p>Estamos preparados para processar pagamentos em <span
                        class="badge badge-pill badge-primary">Referência
                        multibanco (MB)</span> e <span class="badge badge-pill badge-secondary">MBWAY</span></p>
                <p>Se desejar utilizar estes métodos, deverá criar conta em <a href="https://ifthenpay.com/"
                        target="_new">IFTHENPAY (https://ifthenpay.com)</a>.</p>
                <p>Depois de criar conta, deve solicitar os códigos <span
                        class="badge badge-pill badge-primary">MBKEY</span> e <span
                        class="badge badge-pill badge-secondary">MBWAYKEY</span> e inserir abaixo.</p>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>MBKEY</label>
                        <input type="text" class="form-control" name="mb_key" value="{{ $ifthen_pay->mb_key }}">
                    </div>
                    <div class="alert alert-info" role="alert">
                        Para receber as notificações automáticas dos pagamentos por referência multibanco, deve devolver
                        à IFTHENPAY a sua chave antiphishing MB e o callback abaixo.
                    </div>
                    <div class="form-group">
                        <label>Chave antiphishing multibanco</label>
                        <input type="text" class="form-control" disabled value="{{ $ifthen_pay->mb_antiphishing }}">
                    </div>
                    <div class="form-group">
                        <label>Callback MULTIBANCO</label>
                        <textarea class="form-control"
                            disabled>https://comerciodacidade.pt/payments/mb-callback?chave=[CHAVE_ANTI_PHISHING]&referencia=[REFERENCIA]&idpedido=[ID_TRANSACAO]&valor=[VALOR]&datahorapag=[DATA_HORA_PAGAMENTO]&estado=[ESTADO]</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>MBWAYKEY</label>
                        <input type="text" class="form-control" name="mbway_key" value="{{ $ifthen_pay->mbway_key }}">
                    </div>
                    <div class="alert alert-info" role="alert">
                        Para receber as notificações automáticas dos pagamentos por MBWAY, deve devolver à IFTHENPAY a
                        sua chave antiphishing MBWAY e o callback abaixo.
                    </div>
                    <div class="form-group">
                        <label>Chave antiphishing MBWAY</label>
                        <input type="text" class="form-control" disabled value="{{ $ifthen_pay->mbway_antiphishing }}">
                    </div>
                    <div class="form-group">
                        <label>Callback MBWAY</label>
                        <textarea class="form-control"
                            disabled>https://comerciodacidade.pt/payments/mbway-callback?key=[ANTI_PHISHING_KEY]&orderId=[ORDER_ID]&amount=[AMOUNT]&requestId=[REQUEST_ID]&entity=[ENTITY]&reference=[REFERENCE]&payment_datetime=[PAYMENT_DATETIME]</textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Gravar</button>
        </div>
    </form>
</div>

@endsection