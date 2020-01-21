<?php

namespace App\Support;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class ProductCollection extends Collection
{
    /**
     * Filter the products
     *
     * @return static
     */
    public function withCategoryAvailable()
    {
        $categories = Category::where('deleted_at', null)->pluck('id');
        return $this->whereIn('category_id', $categories);
    }
}
