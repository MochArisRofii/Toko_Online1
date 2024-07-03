<?php

namespace Modules\Shop\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductAttribute;
use Modules\Shop\Models\ProductInventory;
use Modules\Shop\Models\Tag;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $user = User::first();

        Attribute::setDefaultAttributes();
        $this->command->info('Default Attribute Seed');
        $attributeWeight = Attribute::where('code', Attribute::ATTR_WEIGHT)->first();

        Category::factory()->count(10)->create();
        $this->command->info('Category Seed');
        $randomCategoryIds = Category::all()->random()->limit(2)->pluck('id');

        Tag::factory()->count(10)->create();
        $this->command->info('Tags Seed');
        $randomTagIds = Tag::all()->random()->limit(2)->pluck('id');


        for ($i = 1; $i <= 10; $i++) {
            $manageStock = (bool)random_int(0, 1);

            $product = Product::factory()->create([
                'user_id' => $user->id,
                'manage_stock' => $manageStock,
            ]);

            $product->categories()->sync($randomCategoryIds);

            

            $product->tags()->sync($randomTagIds);

            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $attributeWeight->id,
                'integer_value' => random_int(200, 2000) //inisiasi nanti ke bentuk /gram
            ]);

            if ($manageStock) {
                ProductInventory::create([
                    'product_id' => $product->id,
                    'qty' => random_int(3, 20),
                    'low_stock_threshold' => random_int(1, 3),
                ]);
            }
        }


        $this->command->info('10 sampel product seed');


        

    }
}
