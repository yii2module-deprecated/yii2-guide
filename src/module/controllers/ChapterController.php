<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\module\Module;

class ChapterController extends Controller {

	public function actionView($id = null) {
		$entity = Yii::$app->guide->chapter->oneById($id);
		$collection = Yii::$app->guide->chapter->allByParentId($id);
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], [Module::URL_ARTICLE_INDEX]);
		if($id) {
			$breadcrumbs->create($entity->title, [Module::URL_CHAPTER_VIEW, 'id' => $entity->id]);
		}
		return $this->render('index', compact('entity', 'collection'));
	}

}
