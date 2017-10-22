<?php

/* @var $this yii\web\View */

use yii2module\guide\module\helpers\ViewHelper;

$this->title = $entity->title;
$html = ViewHelper::replaceLink($entity->html);
?>

<div class="guide-index">

	<?= $html ?>

</div>
