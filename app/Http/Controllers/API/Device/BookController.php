<?php

namespace App\Http\Controllers\API\Device;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Device\BulkCreateBookAPIRequest;
use App\Http\Requests\Device\BulkUpdateBookAPIRequest;
use App\Http\Requests\Device\CreateBookAPIRequest;
use App\Http\Requests\Device\UpdateBookAPIRequest;
use App\Http\Resources\Device\BookCollection;
use App\Http\Resources\Device\BookResource;
use App\Repositories\BookRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class BookController extends AppBaseController
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Book's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return BookCollection
     */
    public function index(Request $request): BookCollection
    {
        $books = $this->bookRepository->fetch($request);

        return new BookCollection($books);
    }

    /**
     * Create Book with given payload.
     *
     * @param CreateBookAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return BookResource
     */
    public function store(CreateBookAPIRequest $request): BookResource
    {
        $input = $request->all();
        $book = $this->bookRepository->create($input);

        return new BookResource($book);
    }

    /**
     * Get single Book record.
     *
     * @param int $id
     *
     * @return BookResource
     */
    public function show(int $id): BookResource
    {
        $book = $this->bookRepository->findOrFail($id);

        return new BookResource($book);
    }

    /**
     * Update Book with given payload.
     *
     * @param UpdateBookAPIRequest $request
     * @param int                  $id
     *
     * @throws ValidatorException
     *
     * @return BookResource
     */
    public function update(UpdateBookAPIRequest $request, int $id): BookResource
    {
        $input = $request->all();
        $book = $this->bookRepository->update($input, $id);

        return new BookResource($book);
    }

    /**
     * Delete given Book.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->bookRepository->delete($id);

        return $this->successResponse('Book deleted successfully.');
    }

    /**
     * Bulk create Book's.
     *
     * @param BulkCreateBookAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return BookCollection
     */
    public function bulkStore(BulkCreateBookAPIRequest $request): BookCollection
    {
        $books = collect();

        $input = $request->get('data');
        foreach ($input as $key => $bookInput) {
            $books[$key] = $this->bookRepository->create($bookInput);
        }

        return new BookCollection($books);
    }

    /**
     * Bulk update Book's data.
     *
     * @param BulkUpdateBookAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return BookCollection
     */
    public function bulkUpdate(BulkUpdateBookAPIRequest $request): BookCollection
    {
        $books = collect();

        $input = $request->get('data');
        foreach ($input as $key => $bookInput) {
            $books[$key] = $this->bookRepository->update($bookInput, $bookInput['id']);
        }

        return new BookCollection($books);
    }
}
