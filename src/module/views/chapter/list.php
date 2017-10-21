<?php

/* @var $this yii\web\View */

use yii\widgets\Menu;
use yii2module\guide\domain\helpers\ArticleHelper;
use yii2module\guide\module\Module;

$this->title = $entity->title;
?>

<h1>
	<?= $entity->title ?>
</h1>

<?= Menu::widget([
	'items' => ArticleHelper::collectionToItems($entity->articles, Module::URL_ARTICLE_VIEW)
]) ?>
