<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\guide\module\helpers\NavigationHelper;

$this->title = t('guide/article', 'title');
$url = NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_UPDATE, compact('id'));
Yii::$app->notify->flash->send(['guide/article', 'not_found'], Alert::TYPE_DANGER, null);
$buttonVisibleClass = !Yii::$app->user->can('guide.modify') ? 'hidden' : '';
?>

<?= Html::a(t('action', 'CREATE'), $url, [
		'class' => 'btn btn-primary ' . $buttonVisibleClass,
	]) ?>
<br/>
