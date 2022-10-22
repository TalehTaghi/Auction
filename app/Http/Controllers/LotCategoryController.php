<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotCategoryRequest;
use App\Models\LotCategory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LotCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $categories = LotCategory::all();

            if (!$categories || $categories->isEmpty())
                return parent::respond('Could not found categories', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully fetched all categories', $categories);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_FETCHED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LotCategoryRequest $request
     * @return JsonResponse
     */
    public function store(LotCategoryRequest $request): JsonResponse
    {
        try {
            $category = LotCategory::create($request->all());

            if (!$category)
                return parent::respond('Could not create a category', null, 'NOT_CREATED', Response::HTTP_BAD_REQUEST);

            return parent::respond('Successfully created a category', $category);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_CREATED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = LotCategory::find($id);

            if (!$category)
                return parent::respond('Could not found a category', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully found a category', $category);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_FETCHED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LotCategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LotCategoryRequest $request, int $id): JsonResponse
    {
        try {
            $status = LotCategory::where('id', $id)->update($request->all());

            if (!$status)
                return parent::respond('Could not update a category', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully updated a category');
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_UPDATED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $status = LotCategory::where('id', $id)->delete();

            if (!$status)
                return parent::respond('Could not delete a category', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully deleted a category');
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_DELETED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
