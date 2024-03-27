<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $fillable = ['in_stock','category_id','stock','item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
