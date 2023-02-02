<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOption extends BaseModel
{

   protected $table = 'type_options';

   protected $fillable = ['type_spec_id','name'];

   protected $hidden = ['created_at','updated_at'];

   protected $casts =[
       'type_spec_id' => 'integer',
   ];

    public function typeSpec()
    {
        return $this->belongsTo(TypeSpec::class,'type_spec_id');
    }

    public function propertyOptions()
    {
        return $this->hasMany(PropertyOption::class);
    }

}
