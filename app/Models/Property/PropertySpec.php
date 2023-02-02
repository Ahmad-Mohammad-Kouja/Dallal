<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertySpec extends BaseModel
{

    protected $table = 'property_specs';

    protected $fillable = ['property_id','type_spec_id'];

    protected $hidden = ['created_at','updated_at'];

    public $casts = [
        'property_id' => 'integer',
        'type_spec_id' => 'integer'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }

    public function typeSpec()
    {
        return $this->belongsTo(TypeSpec::class,'type_spec_id');
    }

    public function propertyOptions()
    {
        return $this->hasMany(PropertyOption::class);
    }

}
