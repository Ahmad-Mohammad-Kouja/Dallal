<?php

namespace App\Models\Address;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class City extends BaseModel
{
    protected $table = 'cities';

    protected $fillable = ['name','country_id'];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'country_id' => 'integer'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

}
