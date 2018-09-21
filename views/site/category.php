<?php

/* @var $this yii\web\View */
use app\adapters\Category;

$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Category</h1>

        <p class="lead">Task: просмотр списка категорий с количеством товаров в категории</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2 id="main_item">List of categories with number of items</h2>
                <?php Category::DisplayCategoryTable(); ?>
            </div>
        </div>
    </div>
</div>
