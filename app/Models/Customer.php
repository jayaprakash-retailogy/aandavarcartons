<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'customer';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "email", "phone", "address", "gst", "notes", "is_active", "added_by", "deleted_by", "deleted_at"
    ];

    public function jobcardmodel() {
        return $this->hasMany('App\Models\JobCard', 'customer_id');
    }

    public function pocustomers() {
        return $this->hasMany('App\Models\PurchaseOrders', 'customer_id');
    }
}
