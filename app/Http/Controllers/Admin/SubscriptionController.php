<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubscriptionRequest;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscriptions = Subscription::with(['user', 'subscription_type.plan'])->get();

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('subscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subscription_types = SubscriptionType::with('plan')->get();

        return view('admin.subscriptions.create', compact('subscription_types', 'users'));
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->all());

        return redirect()->route('admin.subscriptions.index');
    }

    public function edit(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subscription_types = SubscriptionType::with('plan')->get();

        $subscription->load('user', 'subscription_type');

        return view('admin.subscriptions.edit', compact('subscription', 'subscription_types', 'users'));
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->all());

        return redirect()->route('admin.subscriptions.index');
    }

    public function show(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscription->load('user', 'subscription_type.plan');

        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function destroy(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscription->delete();

        return back();
    }

    public function massDestroy(MassDestroySubscriptionRequest $request)
    {
        $subscriptions = Subscription::find(request('ids'));

        foreach ($subscriptions as $subscription) {
            $subscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
