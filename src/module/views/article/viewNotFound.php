<?php

/* @var $this yii\web\View */

use common\enums\rbac\PermissionEnum;
use yii\helpers\Html;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\guide\module\helpers\NavigationHelper;

$this->title = Yii::t('guide/article', 'title');
$url = NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_UPDATE, compact('id'));
Yii::$app->navigation->alert->create(['guide/article', 'not_found'], Alert::TYPE_DANGER, null);
$buttonVisibleClass = !Yii::$app->user->can(PermissionEnum::GUIDE_MODIFY) ? 'hidden' : '';
?>

<?= Html::a(t('action', 'create'), $url, [
		'class' => 'btn btn-primary ' . $buttonVisibleClass,
	]) ?>
<br/>
