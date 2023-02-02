<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOption extends BaseModel
{

    protected $table = 'property_options';

    protected $fillable = ['property_spec_id','type_option_id'];

    protected $hidden = ['created_at','updated_at'];

    protected $casts =[
        'property_spec_id' => 'integer',
        'type_option_id' => 'integer',
    ];

    public function propertySpec()
    {
        return $this->belongsTo(PropertySpec::class,'property_spec_id');
    }

    public function typeOption()
    {
        return $this->belongsTo(TypeOption::class,'type_option_id');
    }

}
