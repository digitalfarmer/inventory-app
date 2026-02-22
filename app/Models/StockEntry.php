<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    //
    protected $fillable = ['product_id', 'qty', 'description', 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
