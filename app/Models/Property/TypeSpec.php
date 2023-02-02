<?php

namespace App\Models\Property;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeSpec extends BaseModel
{

    protected $table = 'type_specs';

    protected $fillable = ['type_id','name','has_multiple_option'];

    protected $hidden = ['created_at','updated_at'];

    public $casts = [
        'type_id' => 'integer',
        'has_multiple_option' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function typeOptions()
    {
        return $this->hasMany(TypeOption::class);
    }

    public function getData($filter,$orderType = 'DESC',$orderColumn ='id')
    {
        return self::where($filter)
            ->with(['typeOptions'])
            ->orderBy($orderColumn,$orderType)
            ->get();
    }

    public function getWithOptions($optionsData)
    {
        return self::whereHas('options',function ($option) use($optionsData){
            $option->whereIn('type_options.id',$optionsData);})
            ->with(['options'=>function ($options) use ($optionsData){
                $options->whereIn('id',$optionsData);
            }])->get();
    }

}
