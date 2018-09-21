<?php

/* @var $this yii\web\View */
use app\adapters\Category;
use app\adapters\Brands;

$this->title = 'My Yii Application';
?>
<div class="site-about">

    <div class="jumbotron">
        <h1>Brands</h1>

        <p class="lead">Task: просмотр списка брэндов с кол-вом комментариев (оставленных к товарам этих брендов)</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2 id="main_item">List of categories with number of items</h2>
                <?php
                    Brands::DisplayBrandsWithAmountComments();

                    ?>
            </div>
        </div>
    </div>
</div>
