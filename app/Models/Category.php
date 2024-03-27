<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    // Define relationship with items
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Define relationship with purchases
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
