<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'purchase_orders';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
    'customer_id', 'supplier_id', 'type', 'purchaseordernumber', 'purchaseorderdate', 'terms_of_payment', 'progress', 'status', 'users_id', 'is_active', 'deleted_at'
    ];
}
