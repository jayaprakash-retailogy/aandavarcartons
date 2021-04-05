<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'employee';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'phone', 'email', 'address', 'aadhar', 'pan', 'users_id', 'is_active', 'deleted_at', 'created_date', 'salary'
    ];

    /*public function jobcardmodel() {
        return $this->hasMany('App\Models\Employee', 'employee_id');
    }*/
}
