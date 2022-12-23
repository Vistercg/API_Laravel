<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CategoryFilter extends ApiFilter {
    protected $safeParams = [
        'name' => ['eq'],
        'content' => ['eq'],
        'slug' => ['eq'],
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];
}
