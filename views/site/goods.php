<?php

/* @var $this yii\web\View */
use app\adapters\Category;
use app\adapters\Product;
use app\models\ProductData;

$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Goods in category</h1>

        <p class="lead">Task: просмотр списка товаров категории  (название, цена, картинка, 300 символов описания )</p>
    </div>

    <div class="body-content">
        <div class="row">
                <h2 id="main_item">Display goods of each category.</h2>
            <div class="col-lg-4">
                <?php
                    $categories = Category::GetCategoriesNames();
                    $amount = count($categories);
                    for($i = 0; $i < $amount; $i++)
                    {
                        echo "<h3>".$categories[$i]["cname"]."</h3>";
                        $products = Product::GetProductsByCategoryName($categories[$i]["cname"]);
                        $a_products = count($products);
                        for($j=0;$j<$a_products;$j++)
                        {
                            $name = $products[$j]->product_info["name"];
                            $brand = $products[$j]->product_info["bname"];
                            $descript = $products[$j]->product_info["description"];
                            $id = $products[$j]->product_info["product_id"];
                            $categ = $products[$j]->product_info["cname"];
                            $price = $products[$j]->product_info["price"];

                            Product::WriteProductOverwievBlock($name,$brand,$descript,$id,$price, $categ);
                        }
                    }
                    
                ?>
            </div>
        </div>
    </div>
</div>
