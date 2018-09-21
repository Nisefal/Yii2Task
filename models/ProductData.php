<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/21/2018
 * Time: 8:50 PM
 */

namespace app\models;


class ProductData
{
    public function __construct($product_info, $images)
    {
        $this->product_info = $product_info;
        $this->images = $images;
    }
}