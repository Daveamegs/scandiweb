<?php

require_once "Product.php";

class DVD extends Product
{
    protected $size;
    private $database;

    public function __construct($SKU, $name, $price, $product_type, $size) 
    {
        parent::__construct($SKU, $name, $price, $product_type);
        $this->database = new Database;
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function create()
    {
        if($this->SKU || $this->name || $this->price || $this->size !== "")
        {
            try {
                $connection = $this->database::getInstance();
                $query = "INSERT INTO products(SKU, name, price, type, size) VALUES(:SKU, :name, :price, :product_type, :size)";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":SKU", $this->SKU);
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":price", $this->price);
                $stmt->bindParam(":product_type", $this->product_type);
                $stmt->bindParam(":size", $this->size);

                if($stmt->execute())
                {
                    http_response_code(201);
                    echo json_encode(array("success" => true, "message" => "Product created successfully"));
                }
            } catch (PDOException $e) {
               echo json_encode(array("success" => false, "message" => $e->getMessage()));
            }
            
        } else
        {
            echo json_encode(array("success" => false, "message" => "Invalid Parameters"));
        }
    }

    public function read()
    {
        # code...
    }
}