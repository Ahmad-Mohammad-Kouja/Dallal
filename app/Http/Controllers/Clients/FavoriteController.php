<?php

namespace App\Http\Controllers\Clients;

use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Favorite\CreateFavoriteRequest;
use App\Http\Requests\Client\Favorite\DeleteFavoriteRequest;
use App\Models\Clients\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favorite;


    public function __construct(Favorite $favorite)
    {
        $this->favorite=$favorite;
    }

    public function create(CreateFavoriteRequest $request)
    {
        $data = ['property_id' => $request->get('property_id'), 'user_id' => $request->user()->id];
        $oldFavorite = $this->favorite->findData($data);
        if(!empty($oldFavorite))
            $status = $this->favorite->forceDeleteData($data);
        else $status = $createdFavorite = $this->favorite->createData($data);
        return empty($status) ? ResponseHelper::generalError() : ResponseHelper::insert('success');
    }

    public function get(Request $request)
    {
        return ResponseHelper::select($this->favorite->getData(['user_id' => $request->user()->id]));
    }
}
