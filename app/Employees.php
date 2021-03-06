<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'company_id', 'phone'
    ];

    public function company()
    {
        return $this->hasOne('App\Companies','id','company_id');
    }

}
