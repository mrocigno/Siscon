<?php


namespace App\Utils;


class ResponseJsonUtil{

    public static function response($code, $message, $data){
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }

}