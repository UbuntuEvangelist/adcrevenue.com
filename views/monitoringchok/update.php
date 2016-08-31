<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Monitoringchok */

$this->title = Yii::t('app', 'আপডেট চ্যাট: ', [
    'modelClass' => 'Monitoringchok',
]) . $model->kromikNong;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monitoringchoks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kromikNong, 'url' => ['view', 'id' => $model->kromikNong]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="monitoringchok-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
