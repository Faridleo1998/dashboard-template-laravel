<?php

namespace App\Services;

use App\Helpers\FiltersTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserService
{
    use FiltersTrait;

    protected $globalSearch;

    public function __construct()
    {
        $this->globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('identification_number', 'LIKE', "%{$value}%")
                        ->orWhere('full_name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
    }

    public function getAll()
    {
        return QueryBuilder::for(User::class)
            ->select('id', 'identification_number', 'full_name', 'email', 'status')
            ->defaultSort('-created_at')
            ->allowedSorts(['identification_number', 'full_name', 'email', 'status'])
            ->allowedFilters(['status', $this->globalSearch, $this->startCreatedDate(), $this->endCreatedDate()])
            ->paginate(request()->get('perPage', 15))
            ->withQueryString();
    }
}
