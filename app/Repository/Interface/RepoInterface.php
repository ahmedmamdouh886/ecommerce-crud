<?php

namespace App\Repository\Interface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepoInterface
{
    /**
     * Get collection of model instances.
     * 
     * @param int $perPage
     * @param array<int, string> $columns
     * 
     * @return LengthAwarePaginator
     */
    public function get(int $perPage = 10, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Find model instance by ID.
     * 
     * @param int $id
     * 
     * @return array<string, mixed>
     * 
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): array;

    /**
     * Find model instance by ID.
     * 
     * @param array $attributes
     * 
     * @return void
     */
    public function create(array $attributes): void;

    /**
     * Update an instance by ID.
     * 
     * @param int $id
     * @param array $attributes
     * 
     * @return void
     */
    public function update(int $id, array $attributes): void;

    /**
     * Delete an instance by ID.
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id): void;
}
