<?php

/* @var $this yii\web\View */

use yii2module\guide\domain\helpers\ArticleHelper;

$this->title = $entity->title;
$html = ArticleHelper::replaceLink($entity->html);
?>

<div class="guide-index">

	<?= $html ?>

</div>
