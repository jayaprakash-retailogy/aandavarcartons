<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'settings';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'address', 'city', 'pincode', 'state', 'phone', 'email', 'gst', 'is_active', 'created_date', 'user_id'
    ];
}
