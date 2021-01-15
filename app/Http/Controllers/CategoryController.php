<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['index', 'show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CategoryResource
     */
    public function store(Request $request): CategoryResource
    {
        return new CategoryResource(Category::create([
            'name' => $request->input('name'),
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category): CategoryResource
    {
        $category->slug = null;
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json([
            'message' => __('crud.delete.success', [
                'attribute' => __('validation.attributes.category')
            ])
        ]);
    }
}
