<?php
namespace App;
class ErrorHandler{
    public static function handle(\Throwable $ex){
        echo(json_encode(([
            "code" => $ex->getCode(),
            "message"=> $ex->getMessage(),
            "file"=> $ex->getFile(),
            "line"=> $ex->getLine(),
            ]))
        );
    }
}


?>