<?php

namespace Database\Factories;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
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

        $random_id = $faker->randomElement($categories);


        $name = fake()->name();
        return [
            //return [
            'name' => $name,
            'status' => rand(0,1),
            'slug' => UtilsFactory::nameToSlug($name),
            'category_id'=>$random_id
            
        ];
    }
}
