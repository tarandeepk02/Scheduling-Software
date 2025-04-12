<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	
	protected $table = 'clients';
	
	protected $primaryKey = 'client_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
    protected $fillable = [
        'title', 'first_name', 'last_name', 'company_name', 'phone_type', 'phone', 'email_type', 'email', 'address', 'street_number', 'street_route', 'city', 'state', 'postal_code', 'country'
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
