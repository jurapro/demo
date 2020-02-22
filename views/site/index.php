<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

?>

<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(['id' => 'requests']); ?>

    <h2>Всего обработанно заявок: <span id="count"><?= Html::encode($count) ?></span></h2>
    <h3>Последние обработанные заявки</h3>
    <?php foreach ($requests as $request): ?>
        <h4><?= Html::encode($request->name) ?></h4>
    <?php endforeach; ?>

    <?php Pjax::end(); ?>

    <?php
    $this->registerJs(
        '
        let count=$("#count").text();
        setInterval(()=>{
        $.pjax.reload(\'#requests\');
        
        if (count !== $("#count").text()) {
            count=$("#count").text();
            let audio = new Audio(\'/sound/sound.mp3\');
            audio.play();
        }     
        
        },3000)
        ',
        View::POS_READY,
        'pjax'
    );
    ?>

</div>