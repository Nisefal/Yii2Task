<?php

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Attention!</h1>

        <p class="lead">This is a test application made with Yii2 framework.</p>
    </div>
    <?php \app\adapters\Category::WriteGoodBlock('lol', 'kek', 'none', 2, 'acunamatata') ?>
    <div class="body-content">

    </div>
</div>
