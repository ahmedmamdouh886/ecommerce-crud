<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreProductRequest;
use App\Http\Requests\API\v1\UpdateProductRequest;
use App\Http\Resources\API\v1\ProductResource;
use App\Repository\Interface\RepoInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * How many rows you want in each pagination page.
     *
     * @var int
     */
    const PER_PAGE = 10;

    /**
     * Product repo instance.
     * 
     * @param \App\Repository\Interface\RepoInterface $productRepo
     */
    protected RepoInterface $productRepo;

    /**
     * Class initialization.
     * 
     * @param \App\Repository\Interface\RepoInterface $repoInstance
     * 
     * @return void
     */
    public function __construct(RepoInterface $repoInstance)
    {
        $this->productRepo = $repoInstance;
    }

    /**
     * List paginated products.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return void
     */
    public function index(Request $request)
    {
        return ProductResource::collection($this->productRepo->get(self::PER_PAGE));
    }

    /**
     * Store a product.
     * 
     * @param \App\Http\Requests\API\v1\StoreProductRequest $request
     * 
     * @return Json
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepo->create($request->all());

        return response()->json(['message' => __('Created successfully!')], Response::HTTP_CREATED);
    }

    /**
     * Display a product by ID.
     * 
     * @param int $id
     * 
     * @return Json
     */
    public function show(int $id)
    {
        return new ProductResource($this->productRepo->find($id));
    }

    /**
     * Update a product by ID.
     * 
     * @param \App\Http\Requests\API\v1\UpdateProductRequest $request
     * @param int $id
     * 
     * @return Json
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $this->productRepo->update($id, $request->all());

        return response()->json(['message' => __('Updated successfully!')], Response::HTTP_OK);
    }

    /**
     * Remove a product by ID.
     * 
     * @param int $id
     * 
     * @return Json
     */
    public function destroy(int $id)
    {
        $this->productRepo->delete($id);

        return response()->json(['message' => __('Deleted successfully!')], Response::HTTP_OK);
    }
}
