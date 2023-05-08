<?php
require_once "../app/model/ProductType.php";
require_once "../app/model/Book.php";
require_once "../app/model/DVD.php";
require_once "../app/model/Furniture.php";

class ProductFactory
{
    public static function createProduct($SKU, $name, $price, $product_type, $args)
    {
        switch ($product_type)
        {
            case ProductType::BOOK:
                return new Book($SKU, $name, $price, $product_type, $args["weight"]);
            
            case ProductType::DVD:
                return new DVD($SKU, $name, $price, $product_type, $args["size"]);

            case ProductType::FURNITURE:
                return new Furniture($SKU, $name, $price, $product_type, $args["height"], $args["width"], $args["length"]);

            default:
                throw new Exception("Invalid Product Type");
        }
    }

}