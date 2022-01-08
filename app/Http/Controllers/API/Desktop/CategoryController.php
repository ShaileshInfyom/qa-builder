<?php

namespace App\Http\Controllers\API\Desktop;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Desktop\BulkCreateCategoryAPIRequest;
use App\Http\Requests\Desktop\BulkUpdateCategoryAPIRequest;
use App\Http\Requests\Desktop\CreateCategoryAPIRequest;
use App\Http\Requests\Desktop\UpdateCategoryAPIRequest;
use App\Http\Resources\Desktop\CategoryCollection;
use App\Http\Resources\Desktop\CategoryResource;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class CategoryController extends AppBaseController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Category's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return CategoryCollection
     */
    public function index(Request $request): CategoryCollection
    {
        $categories = $this->categoryRepository->fetch($request);

        return new CategoryCollection($categories);
    }

    /**
     * Create Category with given payload.
     *
     * @param CreateCategoryAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CategoryResource
     */
    public function store(CreateCategoryAPIRequest $request): CategoryResource
    {
        $input = $request->all();
        $category = $this->categoryRepository->create($input);

        return new CategoryResource($category);
    }

    /**
     * Get single Category record.
     *
     * @param int $id
     *
     * @return CategoryResource
     */
    public function show(int $id): CategoryResource
    {
        $category = $this->categoryRepository->findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update Category with given payload.
     *
     * @param UpdateCategoryAPIRequest $request
     * @param int                      $id
     *
     * @throws ValidatorException
     *
     * @return CategoryResource
     */
    public function update(UpdateCategoryAPIRequest $request, int $id): CategoryResource
    {
        $input = $request->all();
        $category = $this->categoryRepository->update($input, $id);

        return new CategoryResource($category);
    }

    /**
     * Delete given Category.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->categoryRepository->delete($id);

        return $this->successResponse('Category deleted successfully.');
    }

    /**
     * Bulk create Category's.
     *
     * @param BulkCreateCategoryAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CategoryCollection
     */
    public function bulkStore(BulkCreateCategoryAPIRequest $request): CategoryCollection
    {
        $categories = collect();

        $input = $request->get('data');
        foreach ($input as $key => $categoryInput) {
            $categories[$key] = $this->categoryRepository->create($categoryInput);
        }

        return new CategoryCollection($categories);
    }

    /**
     * Bulk update Category's data.
     *
     * @param BulkUpdateCategoryAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CategoryCollection
     */
    public function bulkUpdate(BulkUpdateCategoryAPIRequest $request): CategoryCollection
    {
        $categories = collect();

        $input = $request->get('data');
        foreach ($input as $key => $categoryInput) {
            $categories[$key] = $this->categoryRepository->update($categoryInput, $categoryInput['id']);
        }
        CategoryResource::isUsingBulkUpdate();

        return new CategoryCollection($categories);
    }
}
