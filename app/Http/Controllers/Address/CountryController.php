<?php

namespace App\Http\Controllers\Address;

use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Address\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countries;

    /**
     * CountryController constructor.
     * @param Country $countries
     */
    public function __construct(Country $countries)
    {
        $this->countries = $countries;
    }

    public function all(Request $request)
    {
        return ResponseHelper::select($this->countries->allData());
    }
}
