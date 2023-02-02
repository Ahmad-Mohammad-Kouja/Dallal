<?php

namespace App\Http\Controllers\Property;


use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Property\CreatePropertyRequest;
use App\Http\Requests\Property\Property\DeletePropertyRequest;
use App\Http\Requests\Property\Property\GetPropertiesRequest;
use App\Http\Requests\Property\Property\UpdatePropertyRequest;
use App\Models\Property\Image;
use App\Models\Property\Property;
use App\Models\Property\PropertyOption;
use App\Models\Property\PropertySpec;
use App\Models\Property\Type;
use App\Models\Property\TypeSpec;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    protected $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function create(CreatePropertyRequest $request)
    {
        $user = $request->user();
        $dataProperty = $request->only($this->property->getFillable());
        $dataProperty['user_id'] = $user->id;
        DB::beginTransaction();
        $createdProperty = $this->property->createData($dataProperty);
        if (empty($createdProperty)) {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        $propertyId = $createdProperty->id;
        $images = ($request->has('images')) ? $request->get('images') : [];
        $imagesStatues = $this->insertImages($images, $propertyId);
        if (empty($imagesStatues)) {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        $propertySpecStatus = $this->insertPropertySpecs(collect($request->get('specs'))->toCollection()
            , $propertyId, $createdProperty->type_id);
        if (empty($propertySpecStatus)) {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        DB::commit();
        return ResponseHelper::insert();
    }

    public function update(UpdatePropertyRequest $request)
    {
        $user = $request->user();
        $dataProperty = $request->only($this->property->getFillable());
        unset($dataProperty['user_id']);
        $propertyId = $request->get('property_id');

        $property = $this->property->findData(['id' => $propertyId]);
        $this->authorize('update', $property);

        DB::beginTransaction();
        $status = $this->property->updateData(['id' =>$propertyId],$dataProperty);
        if (!$status) {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        //delete images
        $deletedImg=$request->has('deleted_img') ? $request->get('deleted_img') : [];
        $this->deleteImages($deletedImg,$propertyId);

        $images = $request->has('images') ? $request->get('images') : [];
        $imagesStatues = $this->insertImages($images, $propertyId);
        if (empty($imagesStatues))
        {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        //delete specs
        (new PropertySpec())->forceDeleteData(['property_id' => $propertyId]);

        $propertySpecStatus = $this->insertPropertySpecs(collect($request->get('specs'))->recursive()
            ,$propertyId , $request->get('type_id'));
        if (empty($propertySpecStatus))
        {
            DB::rollBack();
            return ResponseHelper::generalError();
        }
        DB::commit();
        return ResponseHelper::update();
    }

    public function delete(DeletePropertyRequest $request)
    {

        $propertyId = $request->get('property_id');
        $property = $this->property->findData(['id' => $propertyId]);
        $this->authorize('delete', $property);
        $status = $this->property->softDelete(['id' => $propertyId]);
        return empty($status) ? ResponseHelper::generalError() : ResponseHelper::delete();
    }

    public function filter(GetPropertiesRequest $request)
    {

        $filter = $request->get('filter',array());
        $minPrice = $request->get('min_price',0);
        $maxPrice = $request->get('max_price',0);
        $minSpace = $request->get('min_space',0);
        $maxSpace = $request->get('max_space',0);
        $searchRange = $request->get('search_range',0);
        $longitude = $request->get('longitude',0);
        $latitude = $request->get('latitude',0);
        $typeId = $request->get('type_id',0);
        $areaId = $request->get('area_id',0);
        $useType = $request->get('use_type');
        $properties = $this->property->filter($typeId, $areaId, $minPrice, $maxPrice, $minSpace, $maxSpace, $searchRange
            , $longitude, $latitude, $filter, $useType,$request->user()->id);
        $propertyIds = $properties->pluck('id');
        $types = new Type();
        $newFilter = $types->allData($propertyIds);
        return ResponseHelper::select(['properties' => $properties, 'new_filter' => $newFilter]);
    }

    private function insertImages($urls, $propertyId)
    {
        $image = new Image();
        $dataImg = array();
        foreach ($urls as $url)
            array_push($dataImg, ['url' => $url, 'property_id' => $propertyId
                , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $status = $image->insertData($dataImg);
        return (empty($status)) ? false : true;
    }

    private function insertPropertySpecs($propertySpec, $propertyId, $typeId)
    {
        $typeSpecs = new TypeSpec();
        $propertySpecs = new PropertySpec();
        $typeSpecsData = $typeSpecs->getData(['type_id' => $typeId]);
        $propertySpecsData = array();
        $propertySpecData['property_id'] = $propertyId;
        $propertySpecData['created_at'] = Carbon::now();
        $propertySpecOptionData = array();
        $index = 0;
        foreach ($typeSpecsData as $typeSpec) {

            $specData = $propertySpec->firstWhere('id', $typeSpec->id);
            if (empty($specData))
                return false;
            $propertySpecData['type_spec_id'] = $typeSpec->id;


            $specOptions = $specData['option'];
            $typeSpecOptions = $typeSpec->typeOptions;
            foreach ($specOptions as $option) {
                if (empty($typeSpecOptions->firstWhere('id', $option)))
                    return false;
            }

            $propertySpecOptionData[$index]['option'] = $specData['option'];
            $propertySpecData['has_multiple_option'] = $typeSpec->has_multiple_option;

            array_push($propertySpecsData, $propertySpecData);
            $index++;
        }
        $insertedPropertySpec = $propertySpecs->insertData($propertySpecsData);
        if (empty($insertedPropertySpec))
            return false;
        $propertySpecsData = $propertySpecs->getData(['property_id' => $propertyId], 'ASC');
        $index = 0;
        $propertySpecsOptions = array();
        $propertySpecsOption['created_at'] = Carbon::now();
        foreach ($propertySpecsData as $propertySpec) {
            $propertySpecsOption['property_spec_id'] = $propertySpec->id;
            foreach ($propertySpecOptionData[$index]['option'] as $propertySpecDatum) {
                $propertySpecsOption['type_option_id'] = $propertySpecDatum;
                array_push($propertySpecsOptions, $propertySpecsOption);
            }
            $index++;
        }
        $propertyOptions = new PropertyOption();
        $insertedPropertySpecOption = $propertyOptions->insertData($propertySpecsOptions);
        if (empty($insertedPropertySpecOption))
            return false;
        return true;
    }

    private function deleteImages($urls, $propertyId)
    {
        $image = new Image();
        $image->forceDeleteData(['property_id' => $propertyId]);
        if (count($urls) > 0) {
            foreach ($urls as $url)
                if (Facades\File::exists(public_path($url)))
                    Facades\File::delete(public_path($url));
        }
        return null;
    }

}

