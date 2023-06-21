<?php
namespace Database\Factories;
use Database\Factories\Utlis;

class UtilsFactory
{
    public static function nameToSlug($name)
    {
        $slug = strtolower($name);
    
        // Replace non-alphanumeric characters with dashes
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    
        // Remove leading and trailing dashes
        $slug = trim($slug, '-');
    
        return $slug;
    }
}