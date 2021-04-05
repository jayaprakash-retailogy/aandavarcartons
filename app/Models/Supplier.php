<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'supplier';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'gst', 'address', 'phone', 'email', 'user_id', 'is_active', 'created', 'deleted_at'
    ];

    public function supplier() {
        return $this->hasMany('App\Models\Stock', 'supplier_id', 'id');
    }
}
