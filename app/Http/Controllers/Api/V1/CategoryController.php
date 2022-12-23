<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Filters\V1\CategoryFilter;
use App\Models\Category;
use App\Http\Requests\V1\StoreCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new CategoryFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        $includeProducts = $request->query('includeProducts');

        $categories = Category::where($queryItems);

        if ($includeProducts) {
            $categories = $categories->with('products');
        }

        return new CategoryCollection($categories->paginate()->appends($request->query())); //сохраняет строку запроса при переходе на след страницу запроса

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $includeProducts = request()->query('includeProducts');

        if($includeProducts){
            return new CategoryResource($category->loadMissing('products'));
        }

        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\V1\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
