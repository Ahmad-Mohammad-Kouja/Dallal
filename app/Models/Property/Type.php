<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends BaseModel
{

    protected $table = 'types';

    protected $fillable = ['name','img'];

    protected $hidden = ['created_at','updated_at'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function typeSpecs()
    {
        return $this->hasMany(TypeSpec::class);
    }

    public function allData($propertyIds = array(),$orderType = 'DESC',$orderColumn = 'id',$paginateSize = 15)
    {
        return self::with(['typeSpecs' => function($typeSpecs) use ($propertyIds)
        {
            return $typeSpecs->when(count($propertyIds) == 0,function ($typeSpec)
            {
              return  $typeSpec->with(['typeOptions']);
            },function ($typeSpecs) use ($propertyIds)
            {
                return $typeSpecs->with(['typeOptions' => function($typeOption) use ($propertyIds)
                {
                    $typeOption->join('property_options','property_options.type_option_id','=','type_options.id')
                        ->join('property_specs','property_specs.id','=','property_options.property_spec_id')
                        ->whereIn('property_specs.property_id',$propertyIds)
                        ->select('type_options.*')
                        ->distinct();
                }]);
            });
        }])->when($propertyIds,function ($types) use ($propertyIds)
        {
            $types->whereHas('typeSpecs' , function($typeSpecs) use ($propertyIds)
            {
                $typeSpecs->join('property_specs','property_specs.type_spec_id','=','type_specs.id')
                    ->whereIn('property_id',$propertyIds);
            });
        })->orderBy($orderColumn,$orderType)
        ->paginate($paginateSize);
    }

}
