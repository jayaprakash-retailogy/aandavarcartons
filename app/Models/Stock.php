<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'roll_stock';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id', 'purchase_order_number', 'purchase_order_date', 'product_no', 'length_mm', 'breadth_mm', 'height_mm', 'user_id', 'is_active', 'timestamp', 'created_date', 'deleted_at'
    ];
}
