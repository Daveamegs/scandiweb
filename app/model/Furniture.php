<?php

require_once "Product.php";

class Furniture extends Product
{
    private $database;
    protected $height;
    protected $width;
    protected $length;

    public function __construct($SKU, $name, $price, $product_type, $height, $width, $length) 
    {
        parent::__construct($SKU, $name, $price, $product_type);
        $this->database = new Database;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function create()
    {
        if($this->SKU || $this->name || $this->price || $this->height || $this->width || $this->length !== "")
        {
            try
            {
                $connection = $this->database::getInstance();
                $query = "INSERT INTO products(SKU, name, price, type, height, width, length) VALUES(:SKU, :name, :price, :product_type, :height, :width, :length)";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":SKU", $this->SKU);
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":price", $this->price);
                $stmt->bindParam(":product_type", $this->product_type);
                $stmt->bindParam(":height", $this->height);
                $stmt->bindParam(":width", $this->width);
                $stmt->bindParam(":length", $this->length);

                if($stmt->execute())
                {
                    http_response_code(201);
                    echo json_encode(array("success" => true, "message" => "Product created successfully"));
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

    public function read()
    {
        # code...
    }
}