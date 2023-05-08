<?php

require_once "../app/core/Database.php";

class DeleteProduct
{
    private $database;
    protected $id;

    public function __construct($id) {
        $this->id = $id;
        $this->database = new Database;
    }

    public function delete()
    {
        if ($this->id !== "")
        {
            $connection = $this->database::getInstance();
            $query = "DELETE FROM products WHERE id = :id";
            $stmt = $connection->prepare($query);
            $stmt->bindValue(":id", $this->id);
            
            if($stmt->execute())
            {
                http_response_code(200);
                echo json_encode(array("success" => true, "message" => "Product deleted successfully"));
            } 
            // else
            // {
            //     http_response_code(404);
            //     echo json_encode(array("success" => false, "message" =>"Failed to delete product"));
            // }
        } else
        {
            http_response_code(404);
            echo json_encode(array("success" => false, "message" => "Invalid ID"));
        }
    }

}