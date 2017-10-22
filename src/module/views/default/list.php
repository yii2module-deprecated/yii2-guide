<?php

/* @var $this yii\web\View
 * @var $collection array */

use yii\widgets\Menu;
use yii2module\guide\module\helpers\NavigationHelper;
use yii2module\guide\module\helpers\ViewHelper;

$this->title = t('guide/main', 'title');
?>

<h1>
	<?= t('guide/project', 'title') ?>
</h1>

<?= Menu::widget([
	'items' => ViewHelper::collectionToItems($collection, NavigationHelper::URL_ARTICLE_INDEX, ['project_id', 'id'])
]) ?>
