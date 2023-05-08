<?php

abstract class Product
{
    protected $SKU;
    protected $name;
    protected $price;
    protected $product_type;

    public function __construct($SKU, $name, $price, $product_type)
    {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
        $this->product_type = $product_type;
    }

    public function getSKU()
    {
        return $this->SKU;
    }

    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function setProductType($product_type)
    {
        $this->product_type = $product_type;
    }

    abstract public function create();
    abstract public function read();
}
