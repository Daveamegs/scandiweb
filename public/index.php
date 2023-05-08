<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

include("../app/init.php");

if($_SERVER["REQUEST_METHOD"] === "GET")
{
    if(isset($_GET["id"]))
    {
        echo json_encode(["id" => $_GET["id"], "success" => true]);
    }else
    {
        $product = new GetAllProducts();
        $product->read();
    }
} elseif($_SERVER["REQUEST_METHOD"] === "POST")
{
    $data = json_decode(file_get_contents("php://input"), true);

    $SKU = $data["SKU"];
    $name = $data["name"];
    $price = $data["price"];
    $product_type = $data["productType"];


    $product = ProductFactory::createProduct($SKU, $name, $price, $product_type, $data);
    
    if($product->create())
    {
        echo json_encode(array("success" => true, "message" => "Product deleted successfully"));
    }
    
} elseif($_SERVER["REQUEST_METHOD"] === "DELETE")
{
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $product = new DeleteProduct($id);
        $product->delete();

    }
}

?>