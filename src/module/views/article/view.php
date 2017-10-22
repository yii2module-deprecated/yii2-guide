<?php

/* @var $this yii\web\View */

use yii2module\guide\module\helpers\ViewHelper;

$this->title = $entity->title;
?>

<?= ViewHelper::markdownToHtml($entity->md) ?>

<br/>
