<?php
namespace App\Controller;
use App;

class UserController{
    private \PDO $pdo;
    public function __construct(App\Database $database) {
        $this->pdo = $database->connect();
    }
    private function fetchDatabase(string $method){
        if($method == "GET"){
            $sql = "SELECT * FROM `product`";
            $stmt = $this->pdo->query($sql);
            $datas = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $datas[] = $row;
            }
            foreach ($datas as $data => $value) {
                return $datas;
            }
        }
    }

    private function getSpecificData(string $method, string $id){
        if($method == "GET"){
            $query = $this->pdo->prepare("SELECT * FROM `product` WHERE id = ?");
            $query->execute();
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            echo(json_encode($result));
        }
    }

    public function getAllData(){
        echo json_encode($this->fetchDatabase("GET"));
    }
}

?>