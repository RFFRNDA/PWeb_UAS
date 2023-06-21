<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private function nameToSlug($name) {
        // Convert name to lowercase
        $slug = strtolower($name);
    
        // Replace non-alphanumeric characters with dashes
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    
        // Remove leading and trailing dashes
        $slug = trim($slug, '-');
    
        return $slug;
    }

    public function definition(): array
    {

        $name = fake()->name();
        return [
            'name' => $name,
            'status' => rand(0,1),
            'slug' => UtilsFactory::nameToSlug($name),
            'image' => null,
        ];
    }
}
