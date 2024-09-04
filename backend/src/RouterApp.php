<?php
require __DIR__.'\..\vendor\autoload.php';
use App\AppServer;
set_exception_handler("App\ErrorHandler::handle");
class RouterApp
{
    // Method untuk menjalankan routing
    public function run()
    {
        // Periksa apakah PHP dijalankan dengan built-in server
        if ($this->isCliServer()) {
            $file = $this->getRequestedFilePath();

            // Jika file yang diminta ada dan merupakan file reguler, biarkan PHP server menanganinya
            if (is_file($file)) {
                return false; // Menghentikan script ini dan biarkan server menangani file
            }
        }

        // Jika file tidak ada, alihkan ke app.php
        $this->routeToApp();
    }

    // Method untuk memeriksa apakah PHP dijalankan dengan built-in server
    private function isCliServer(): bool
    {
        return php_sapi_name() == 'cli-server';
    }

    // Method untuk mendapatkan path file yang diminta
    private function getRequestedFilePath(): string
    {
        return __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    // Method untuk mengalihkan permintaan ke app.php
    private function routeToApp(): void
    {
        $app = new AppServer();
        $app->validateEndpoint();
    }
}

// Buat instance dari Router dan jalankan
$router = new RouterApp();
$router->run();

?>
