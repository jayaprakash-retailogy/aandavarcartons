<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'users';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
       'name', 'username', 'email', 'password', 'pwd_plain', 'userLevel', 'verify_token', 'verify_status', 'remember_token', 'is_active'
    ];
}
