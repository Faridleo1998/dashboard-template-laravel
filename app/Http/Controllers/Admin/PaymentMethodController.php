<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Inertia\Inertia;

class PaymentMethodController extends Controller
{
    use ToastNotificationTrait;

    protected $paymentMethods;

    public function __construct(PaymentMethodService $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;
    }

    public function index()
    {
        $filters = request()->all();
        $paymentMethods = $this->paymentMethods->getAll();

        return Inertia::render('Admin/PaymentMethods/Index', compact('paymentMethods', 'filters'));
    }

    public function create()
    {
        return Inertia::render('Admin/PaymentMethods/Create');
    }

    public function store(PaymentMethodRequest $request)
    {
        $this->paymentMethods->create($request);

        return to_route('payment_methods.index')->with($this->created());
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return Inertia::render('Admin/PaymentMethods/Edit', compact('paymentMethod'));
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $this->paymentMethods->update($request, $paymentMethod);

        return to_route('payment_methods.index')->with($this->updated());
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $this->paymentMethods->delete($paymentMethod);

        return to_route('payment_methods.index')->with($this->deleted());
    }
}
