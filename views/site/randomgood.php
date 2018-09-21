<?php

/* @var $this yii\web\View */
use app\adapters\Category;
use app\adapters\Product;

$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Random products</h1>

        <p class="lead">Task: отображение товара с комментариями к нему и 2 рандомными товарами из этой же категории</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2 id="main_item">List of categories with number of items</h2>
                <?php

                Product::DisplayMostCommentedProductWithRandom();

                ?>
            </div>
        </div>
    </div>
</div>
