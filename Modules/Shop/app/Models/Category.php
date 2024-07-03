<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidTrait;
use Modules\Shop\Database\Factories\CategoryFactory;
class Category extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The attributes that are mass assignable.
     */

    protected $table = 'shop_categories';
    protected $fillable = [
        'parent_id',
        'slug',
        'name',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'shop_categories_products', 'product_id', 'category_id');
    }
}
