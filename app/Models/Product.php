<?php

namespace App\Models;

use App\Services\ProductPriceDiscountManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active products.
     * 
     * @param \Illuminate\Database\Eloquent\Builder
     * 
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Interact with the product's visibility.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function is_active(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (bool) $value,
        );
    }

    /**
     * Interact with the product's name and slug.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => [
                'name' => $value,
                // Assuming that business requirements state that slug will be created from product name.
                'slug' => Str::slug($value),
            ]
        );
    }

    /**
     * Apply a product's discount price.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ProductPriceDiscountManager::apply($value, auth()->user()->type)
        );
    }
}
