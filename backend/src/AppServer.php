<?php
namespace App;
class AppServer
{
    private $endPoint;
    public function __construct()
    {
        $this->endPoint = explode('/', $_SERVER['REQUEST_URI']);
        header("Content-Type: Application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
        set_exception_handler("App\ErrorHandler::handle");
    }

    public function validateEndpoint()
    {
        if (!$this->isUserEndpoint()) {
            $this->sendNotFoundResponse();
        }
        try {
            $userController = new \App\Controller\UserController(new Database());
            $userController->getAllData();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    private function isUserEndpoint()
    {
        if (isset($this->endPoint[1]) && $this->endPoint[1] == 'user' && !isset($this->endPoint[2])) {
            return true;
        }
    }

    private function sendNotFoundResponse(): void
    {
        http_response_code(404);
        echo 'salah blok';
        exit;
    }
}

?>