<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class ProductFilter extends ApiFilter
{
    protected $safeParams = [
        'id' => 'eq',
        'name' => ['eq'],
        'slug' => ['eq'],
        'content' => ['eq'],
        'price' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'typeGender' => ['eq'],
    ];

    protected $columnMap = [
        'typeGender' => 'type_gender',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '≤',
        'gte' => '≥',
    ];

}
