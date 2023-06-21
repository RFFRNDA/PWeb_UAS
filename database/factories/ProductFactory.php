<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $categories = Category::all()->pluck('id')->toArray();
        $random_id_category = $faker->randomElement($categories);   
        
        $sub_categories_id = SubCategory::where('category_id', $random_id_category)->get();
        $random_id_sub_category = $faker->randomElement($sub_categories_id);
        
        $brands = Brand::all()->pluck('id')->toArray();
        $random_id_brand = $faker->randomElement($brands);

        $name = fake()->name();

        $trackqty = (rand(0,1) > 0 ) ? 'Yes' : 'No'; 
        return [
            'title' => $name,
            'slug' => UtilsFactory::nameToSlug($name),
            'description' => "<p>". fake()->paragraph()."</p>",
            'price'=>rand(4,1000),
            'compare_price'=> null,
            'category_id'=>$random_id_category,
            'sub_category_id'=>$random_id_sub_category,
            'brand_id'=>$random_id_brand,
            'track_qty'=>$trackqty,
            'qty'=>rand(0,1000),
            'status'=>rand(0,1),
            'sku'=>fake()->unique()->bothify('??-####')

        ];
    }
}
