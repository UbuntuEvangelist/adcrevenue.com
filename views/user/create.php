<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
?>
<div class="user-create">   

    <div class="col-md-5 well bs-component">

        <?= $this->render('_form', ['user' => $user]) ?>

    </div>

</div>

