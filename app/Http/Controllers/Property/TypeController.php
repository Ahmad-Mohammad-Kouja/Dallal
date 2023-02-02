<?php

namespace App\Http\Controllers\Property;

use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Property\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $types;

    /**
     * TypeController constructor.
     * @param Type $types
     */
    public function __construct(Type $types)
    {
        $this->types = $types;
    }

    public function all(Request $request)
    {
        return ResponseHelper::select($this->types->allData());
    }
}
