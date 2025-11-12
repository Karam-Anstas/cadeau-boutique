<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Occasion extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "image"];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "occasion_product");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "category_occasion")
            ->withTimestamps();
    }
}
