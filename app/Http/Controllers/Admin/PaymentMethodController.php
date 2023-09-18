<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Inertia\Inertia;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->get();

        return Inertia::render('Admin/PaymentMethods/Index', compact('paymentMethods'));
    }

    public function create()
    {
        return Inertia::render('Admin/PaymentMethods/Create');
    }

    public function store(PaymentMethodRequest $request)
    {
        PaymentMethod::create($request->all());

        return to_route('payment_methods.index');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return Inertia::render('Admin/PaymentMethods/Edit', compact('paymentMethod'));
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->fill($request->all());
        $paymentMethod->save();

        return to_route('payment_methods.index');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return to_route('payment_methods.index');
    }
}
