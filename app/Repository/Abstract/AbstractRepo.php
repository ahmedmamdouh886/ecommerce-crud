<?php

namespace App\Repository\Abstract;

use App\Repository\Interface\RepoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepo implements RepoInterface
{
    /**
     * Eloquent model instance.
     * 
     * @var Illuminate\Database\Eloquent\Model
     */
    protected Model $model;
    
    /**
     * Class initialization.
     * 
     * @var Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $modelInstance)
    {
        $this->model = $modelInstance;
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
        return $this->model->latest()->paginate((int) $perPage, $columns);
    }

    /**
     * Find model instance by ID.
     * 
     * @param int $id
     * 
     * @return array<string, mixed>
     * 
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): array {
        return $this->model->findOrFail((int) $id)->toArray();
    }

    /**
     * Find model instance by ID.
     * 
     * @param array $attributes
     * 
     * @return void
     */
    public function create(array $attributes): void {
        // Guard to handle empty attributes.
        if (count($attributes) == 0)
            return;
        
        $this->model->create($attributes);
    }

    /**
     * Update an instance by ID.
     * 
     * @param int $id
     * @param array $attributes
     * 
     * @return void
     */
    public function update(int $id, array $attributes): void {
        // Guard to handle empty attributes.
        if (count($attributes) == 0)
            return;
        
        $this->model->where('id', (int) $id)->update($attributes);
    }

    /**
     * Delete an instance by ID.
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id): void {
        $this->model->where('id', (int) $id)->delete();
    }
}
