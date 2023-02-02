<?php


namespace App\Base;


use App\traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use ModelTrait;


}
