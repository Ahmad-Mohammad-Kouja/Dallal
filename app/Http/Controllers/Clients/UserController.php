<?php

namespace App\Http\Controllers\Clients;

use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Clients\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserData(Request $request)
    {
        $user = $request->user();
        $properties = $request->user()->properties;
        unset($user->properties);
        return ResponseHelper::select(['user' => $user , 'properties' => $properties]);
    }
}
