<?php

namespace App\Services;

use App\Models\PaymentMethod;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentMethodService
{
    protected $globalSearch;

    public function __construct()
    {
        $this->globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%");
                });
            });
        });
    }

    public function getAll()
    {

        return QueryBuilder::for(PaymentMethod::class)
            ->select('title', 'status', 'id')
            ->defaultSort('-created_at')
            ->allowedSorts(['title', 'status'])
            ->allowedFilters(['status', $this->globalSearch])
            ->paginate(request()->get('perPage', 15))
            ->withQueryString();
    }
}
