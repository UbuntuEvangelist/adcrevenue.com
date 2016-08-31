<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Monitoringchok */

$this->title = Yii::t('app', 'Create Monitoringchok');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monitoringchoks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoringchok-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
