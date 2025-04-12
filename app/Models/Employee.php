<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	
	protected $table = 'employees';
	
	protected $primaryKey = 'employee_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'status'
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
