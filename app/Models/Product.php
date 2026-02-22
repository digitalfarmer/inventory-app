<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'name', 'category_id', 'stock', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan StockEntry  
    public function stockEntries() {
    return $this->hasMany(StockEntry::class);
}

}
