<?php


namespace App\Classes;

use App\Classes\ResponseHelper;


class validatorHelper
{
    protected $errors;

    /**
     * validatorHelper constructor.
     * @param $errors
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function checkErrors()
    {
        if(strpos($this->errors,'The selected'))
            return ResponseHelper::isEmpty();
        else if(strpos($this->errors,'already been taken'))
            return ResponseHelper::errorAlreadyExists();
        else if(strpos($this->errors,'valid email address'))
            return ResponseHelper::invalidData();
        else if(strpos($this->errors,'phone number not valid'))
            return ResponseHelper::invalidPhone();
        return ResponseHelper::errorMissingParameter('missing param');
    }
}
