<?php

/* @var $this yii\web\View */

use yii2lab\helpers\yii\Html;
use yii2module\guide\module\helpers\NavigationHelper;
use yii2module\guide\module\helpers\ViewHelper;

$this->title = $entity->title;
$visibleClass = !Yii::$app->user->can('guide.modify') ? 'hidden' : '';
?>

<div class="pull-right <?= $visibleClass ?>">
	<?= Html::a(Html::fa('pencil', ['class' => 'text-primary']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_UPDATE, ['id' => $entity->id]), [
		'class' => 'btn btn-default',
		'title' => t('action', 'UPDATE'),
	]) ?>
	<?= Html::a(Html::fa('trash', ['class' => 'text-danger']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_DELETE, ['id' => $entity->id]), [
		'class' => 'btn btn-default',
		'title' => t('action', 'DELETE'),
		'data' => [
			'confirm' => t('yii', 'Are you sure you want to delete this item?'),
			'method' => 'post',
		],
	]) ?>
</div>

<?= ViewHelper::markdownToHtml($entity->content) ?>

<br/>
