<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use App\Enums\Properties\PropertyUseTypes;
use App\Models\Address\Area;
use App\Models\Clients\Favorite;
use App\Models\Clients\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Property extends BaseModel
{
    use softDeletes;

    protected $table ='properties';

    protected $fillable = ['type_id','user_id','area_id','address', 'longitude','sold_at',
        'latitude','postal_code','description','img','price','space','use_type'];

    protected $dates=['sold_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $enumCasts = [
       'use_type' => PropertyUseTypes::class
    ];

    protected $casts = [
        'type_id' => 'integer',
        'user_id' => 'integer',
        'area_id' => 'integer',
        'price' => 'double',
        'space' =>'double',
        'longitude' =>'double',
        'latitude' =>'double',
        'is_favorite' => 'boolean'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function propertySpecs()
    {
        return $this->hasMany(PropertySpec::class);
    }

    public function propertyOptions()
    {
        return $this->hasManyThrough(PropertyOption::class,PropertySpec::class);
    }


    public function filter($typeId,$areaId,$minPrice, $maxPrice, $minSpace, $maxSpace, $searchRang, $longitude,
                           $latitude,$filters,$useType = null,$userId = 0)
    {
        $properties = $this::when($typeId > 0, function ($property) use ($typeId){
            $property->where('type_id',$typeId);
        })->when($areaId > 0, function ($property) use ($areaId){
            $property->where('area_id',$areaId);
        })->when(!empty($useType) , function ($property) use ($useType)
        {
            $property->where('use_type',$useType);
        })->when($minPrice > 0 || $maxPrice > 0 ,function ($properties) use ($minPrice,$maxPrice)
        {
            $properties->when($minPrice > 0 ,function ($property) use ($minPrice)
            {
                $property->where('price','>=',$minPrice);
            })->when($maxPrice > 0,function ($property) use($maxPrice)
            {
                $property->where('price','<=',$maxPrice);
            });
        })->when($minSpace > 0 || $maxSpace > 0 ,function ($properties) use ($minSpace,$maxSpace)
            {
                $properties->when($minSpace > 0 ,function ($property) use ($minSpace)
                {
                    $property->where('space','>=',$minSpace);
                })->when( $maxSpace > 0,function ($property) use($maxSpace)
                {
                    $property->where('space','<=',$maxSpace);
                });
            })
           ->when($searchRang > 0,function ($property) use ($longitude,$latitude,$searchRang)
            {
                $property->selectRaw(" properties.*,
                     ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", $searchRang);
            })->with('images','user','type')
            ->with(['area' => function($area)
            {
                $area->join('cities','cities.id','=','areas.city_id')
                    ->join('countries','countries.id','=','cities.country_id')
                    ->select('areas.*','cities.id as city_id','cities.name as city_name','countries.id as country_id',
                        'countries.name as country_name');
            }])
            ->with(['propertySpecs' => function ($propertySpec)
            {
                $propertySpec->join('type_specs','type_specs.id','=','property_specs.type_spec_id')
                ->with(['propertyOptions' => function ($propertyOption)
                {
                    $propertyOption->with('typeOption');
                }])->select('property_specs.*','type_specs.name');
            }]);
            if(count($filters) > 0)
            {
                foreach ($filters as $filter)
                {
                    $properties->whereHas('propertySpecs', function ($propertySec) use ($filter) {
                        $propertySec->whereHas('propertyOptions', function ($propertyOption) use ($filter) {

                            $propertyOption->where('type_option_id', $filter['type_option_id'])
                                ->where('type_spec_id', $filter['type_spec_id']);
                        });

                    });
                }
            }
        return $properties->addSelect(['is_favorite' => Favorite::where('favorites.user_id',$userId)
        ->whereColumn('favorites.property_id','properties.id')
           ->select('favorites.id')])
            ->latest()
            ->paginate(20);
    }


}
