<?php


namespace App\Classes;


class ResponseHelper
{

    /**
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function select($data = null)
    {
        return response()->json(['status' => 'OK','data' =>$data], 220);
    }

    /**
     * @param $data Mixed
     * @return \Illuminate\Http\JsonResponse
     */
    public static function insert($data = 'insert success')
    {
        return response()->json(['status' => 'OK', 'data' => $data], 230);
    }
    /**
     * @param $data Mixed
     * @return \Illuminate\Http\JsonResponse
     */
    public static function update($data = null)
    {
        return response()->json(['status' => 'OK', 'data' => $data], 235);
    }

    /**
     * @param $data Mixed
     * deleted Successful
     * @return \Illuminate\Http\JsonResponse
     */
    public static function delete($data = null)
    {
        return response()->json(['status' => 'OK', 'data' => $data], 240);
    }

    /**
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorAlreadyExists($msg = "Already Exists")
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 330);
    }

    /**
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */

    public static function errorMissingParameter($msg = "Missing Required params")
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 400);
    }

    /**
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorNotAllowed($msg = null)
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 460);
    }

    /**
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static function generalError($msg = 'server error')
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 502);
    }
    /**
     * @param mixed
     * not authorized user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notAuthorized($msg = 'un Authorize')
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 550);
    }

    /**
     * @param mixed
     * token miss match exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function tokenMissMatch($msg = "invalid token")
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 499);
    }
    /**
     * @param mixed
     * isEmpty Array exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function isEmpty($msg = null)
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 401);
    }

    public static function invalidData($msg = 'Invalid Data')
    {
        return response()->json(['status' => 'ERROR', 'msg' => $msg], 522);
    }

    public static function invalidPhone($msg = 'invalid phone')
    {
        return response()->json(['status' => 'ERROR' , 'msg' => $msg] , 477);
    }
}
