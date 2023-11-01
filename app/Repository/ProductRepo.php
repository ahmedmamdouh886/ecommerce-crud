<?php

namespace App\Repository;

use App\Models\Product;
use App\Repository\Abstract\AbstractRepo;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepo extends AbstractRepo 
{   
    /**
     * Class initialization.
     * 
     * @var \App\Models\Product
     */
    public function __construct(Product $productInstance) {
        parent::__construct($productInstance);
    }

    /**
     * Get collection of model instances.
     * 
     * @param int $perPage
     * @param array<int, string> $columns
     * 
     * @return LengthAwarePaginator
     */
    public function get(int $perPage = 10, array $columns = ['*']): LengthAwarePaginator {
        return $this->model->active()->latest()->paginate((int) $perPage, $columns);
    }
}
