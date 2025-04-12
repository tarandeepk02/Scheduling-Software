<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Job extends Model
{
	protected $table = 'jobs';
	
	protected $primaryKey = 'job_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'title',
        'instructions',
		//'employees',
		//'status',
		//'start_date',
		//'start_time',
		//'end_date',
		//'end_time',
		'board'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	
	public function clientInfo() {
    	return $this->belongsTo(Client::class,'client_id','client_id'); 
	}

}
