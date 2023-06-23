<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $table = "product_history";

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    
}
