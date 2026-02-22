<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExit extends Model
{
    // Harus sama dengan kolom di database
    protected $fillable = ['product_id', 'qty', 'date', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}