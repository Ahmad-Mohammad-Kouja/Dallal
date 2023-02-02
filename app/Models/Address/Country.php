<?php

namespace App\Models\Address;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Country extends BaseModel
{
    protected $table = 'countries';

    protected $fillable = ['name','currency','currency_short_name','iso_code','country_code'];

    protected $hidden = ['created_at','updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }


    public function allData($orderType = 'DESC',$orderColumn = 'id',$paginateSize = 15)
    {
        return self::with(['cities' => function($country)
        {
            $country->with('areas');
        }])->orderBy($orderColumn,$orderType)
        ->get();
    }
}
