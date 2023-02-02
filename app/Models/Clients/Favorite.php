<?php

namespace App\Models\Clients;

use App\Base\BaseModel;
use App\Models\Clients\User;
use App\Models\Property\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends BaseModel
{
    protected $table = 'favorites';

    protected $fillable = ['property_id','user_id'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected $casts = [
        'property_id' => 'integer',
        'user_id' => 'integer',
    ];

    protected $with = ['property'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class)
            ->with(['area' => function($area)
            {
                $area->join('cities','cities.id','=','areas.city_id')
                    ->join('countries','countries.id','=','cities.country_id')
                    ->select('areas.*','cities.id as city_id','cities.name as city_name','countries.id as country_id',
                        'countries.name as country_name');
            }])->with(['propertySpecs' => function ($propertySpec)
            {
                $propertySpec->join('type_specs','type_specs.id','=','property_specs.type_spec_id')
                    ->with(['propertyOptions' => function ($propertyOption)
                    {
                        $propertyOption->with('typeOption');
                    }])->select('property_specs.*','type_specs.name');
            }])->with('user')
            ->addSelect(['is_favorite' => Favorite::where('favorites.user_id',Auth::id())
                ->whereColumn('favorites.property_id','properties.id')
            ->select('id')]);
    }

}
