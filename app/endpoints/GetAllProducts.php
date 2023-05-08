<?php

require_once "../app/core/Database.php";
require_once "../app/model/Product.php";

class GetAllProducts extends Product
{
    private $database;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->database = new Database;
    }

    public function read()
    {
        $connection = $this->database::getInstance();
        $query = "SELECT
                    p.id,
                    p.SKU,
                    p.name AS product_name,
                    p.price,
                    p.weight,
                    p.size,
                    p.height,
                    p.width,
                    p.length
                    FROM products p
                ";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);
    }

    public function create()
    {
    }
}
