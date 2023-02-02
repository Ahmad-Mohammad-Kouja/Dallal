<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Image extends BaseModel
{

    protected $table = 'images';

    protected $fillable = ['property_id','url'];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'property_id' => 'integer'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }

}
