<?php
require_once "Product.php";

class Book extends Product
{
    private $database;
    protected $weight;

    public function __construct($SKU, $name, $price, $product_type, $weight)
    {
        parent::__construct($SKU, $name, $price, $product_type);
        $this->database = new Database;
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function read()
    {
        
    }   

    public function create()
    {
        if($this->SKU || $this->name || $this->price || $this->weight !== "")
        {
            try
            {
                $connection = $this->database::getInstance();
                $query = "INSERT INTO products(SKU, name, price, type, weight) VALUES(:SKU, :name, :price, :product_type, :weight)";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":SKU", $this->SKU);
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":price", $this->price);
                $stmt->bindParam(":product_type", $this->product_type);
                $stmt->bindParam(":weight", $this->weight);
                
                if($stmt->execute())
                {
                    http_response_code(201);
                    echo json_encode(array("status code" => 201, "success" => true, "message" => "Product created successfully"));
                }
            } catch(PDOException $e)
            {
                echo json_encode(array("success" => false, "message" => $e->getMessage()));
            }
        } else
        {
            echo json_encode(array("success" => false, "message" => "Invalid Parameters"));
        }
    }
}