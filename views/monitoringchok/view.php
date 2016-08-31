<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Monitoringchok */

$this->title = $model->kromikNong;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monitoringchoks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoringchok-view">   

    <p>
	<div class="pull-right" style="padding-bottom:10px;">
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->kromikNong], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->kromikNong], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        </div>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kromikNong',
            'noticeReceivedDate',
            'upazilaNam',
            'mamlaNong',
            'mamlarBochor',
            'biggAdaloterNam',
            'emailSendingDate:email',
            'sfReceiptDate',
            'sfReceiptOriginalDate',
            'sfSendToJusticeDate',
            'montobo',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
