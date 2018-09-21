<?php

/* @var $this yii\web\View */
use app\adapters\Category;

$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Goods in category</h1>

        <p class="lead">Task: просмотр списка товаров категории  (название, цена, картинка, 300 символов описания )</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2 id="main_item">Display goods of each category.</h2>
                <?php Category::WriteCategoryTable(); ?>
            </div>
        </div>
    </div>
</div>
