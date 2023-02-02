<?php


namespace App\traits;


trait ModelTrait
{
    public function createData($data)
    {
        return $this::create($data);
    }

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function updateData($filter,$newData)
    {
        return $this::where($filter)
            ->update($newData);
    }

    public function softDelete($filter)
    {
        return $this::where($filter)
            ->delete();
    }

    public function forceDeleteData($filter)
    {
        return $this::where($filter)
            ->forceDelete();
    }


    public function findData($filter,$orderType = 'ASC' , $orderColumn = 'id')
    {
        return $this::where($filter)
            ->orderBy($orderColumn,$orderType)
            ->first();
    }

    public function getData($filter,$orderType = 'DESC',$orderColumn ='id')
    {
        return $this::where($filter)
            ->orderBy($orderColumn,$orderType)
            ->get();
    }

    public function allData($orderType = 'DESC',$orderColumn = 'id',$paginateSize = 15)
    {
        return $this::orderBy($orderColumn,$orderType)
            ->paginate($paginateSize);
    }
}
