<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'accounts';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
       'date', 'type', 'source', 'paymentstatus', 'amount', 'notes', 'added_by', 'is_active'
    ];
}
