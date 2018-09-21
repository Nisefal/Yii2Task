<?php

/* @var $this yii\web\View */
use app\adapters\Category;
use app\adapters\Product;
$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Product with the gratest amount of comments</h1>

        <p class="lead">Task: отображения самого комментируемого товара со списком комментариев (и именами пользователей, которые оставили комментарий)</p>
    </div>

    <div class="body-content">
        <div class="row">
                <h2 id="main_item">List of categories with number of items</h2>
            <div class="col-lg-4">
                <?php
                    Product::DisplayMostCommentedProduct();
                ?>
            </div>
        </div>
    </div>
</div>
