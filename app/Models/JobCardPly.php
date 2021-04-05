<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardPly extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'jobcard_ply';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'jobcard_id', 'ply_no', 'paper_rate', 'paper_bf', 'gsm_of_paper', 'gsm', 'gsm_calculation', 'paper_cost', 'is_active'
    ];
}
