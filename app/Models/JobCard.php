<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected $table = 'jobcard';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'purchase_order_id', 'item_id', 'quantity', 'length_mm', 'breadth_mm', 'height_mm', 'length_in', 'breadth_in', 'height_in', 'req_reel_size', 'cutting_length_one_side', 'cutting_length_two_side', 'area_sq_inches', 'area_sq_meters', 'box_weight', 'total_paper_cost', 'conversion_cost', 'overall_cost', 'printing_cost', 'total', 'is_active', 'user_id', 'timestamp', 'deleted_at', 'created_date'
    ];
}
