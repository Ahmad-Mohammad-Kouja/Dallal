<?php

namespace App\Models\Address;

use App\Base\BaseModel;
use App\Models\Property\Property;
use Illuminate\Database\Eloquent\Model;

class Area extends BaseModel
{
    protected $table = 'areas';

    protected $fillable = ['name','city_id'];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'city_id' => 'integer'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

}
