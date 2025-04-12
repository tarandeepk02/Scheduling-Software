<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
	
	protected $table = 'boards';
	
	protected $primaryKey = 'board_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
    protected $fillable = [
        'title','color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

	
	public function getOrdersCountAttribute()
	{
		$count = WorkOrder::where('employee_id',$this->id)->count();
		return $count;
	}
	
}
