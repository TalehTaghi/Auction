<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotRequest;
use App\Models\Lot;
use App\Models\LotCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $lots = Lot::join('lot_categories', 'lots.lot_category_id', '=', 'lot_categories.id')
                ->select('lots.id', 'lots.name', 'lots.description', 'lot_categories.name AS category', 'lots.created_at', 'lots.updated_at')
                ->get();

            if (!$lots || $lots->isEmpty())
                return parent::respond('Could not found lots', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully fetched all lots', $lots);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_FETCHED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getByCategories(Request $request): JsonResponse
    {
        try {
            $categoryIds = explode(',', $request->query('categoryIds'));
            $lots = LotCategory::with('lots')->whereIn('lot_categories.id', $categoryIds)->get();

            if (!$lots || $lots->isEmpty())
                return parent::respond('Could not found lots', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully fetched lots by requested categories', $lots);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_FETCHED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LotRequest $request
     * @return JsonResponse
     */
    public function store(LotRequest $request): JsonResponse
    {
        try {
            $lot = Lot::create($request->all());

            if (!$lot)
                return parent::respond('Could not create a lot', null, 'NOT_CREATED', Response::HTTP_BAD_REQUEST);

            return parent::respond('Successfully created a lot', $lot);
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
            $lot = Lot::find($id);

            if (!$lot)
                return parent::respond('Could not found a lot', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully found a lot', $lot);
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_FETCHED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LotRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LotRequest $request, int $id): JsonResponse
    {
        try {
            $status = Lot::where('id', $id)->update($request->all());

            if (!$status)
                return parent::respond('Could not update a lot', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully updated a lot');
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
            $status = Lot::where('id', $id)->delete();

            if (!$status)
                return parent::respond('Could not delete a lot', null, 'NOT_FOUND', Response::HTTP_NOT_FOUND);

            return parent::respond('Successfully deleted a lot');
        } catch (\Exception $exception) {
            return parent::respond($exception->getMessage(), null, 'NOT_DELETED', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
