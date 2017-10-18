<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;

class ChapterController extends Controller {

	public function actionView($id = null) {
		$entity = Yii::$app->guide->chapter->oneById($id);
		$collection = Yii::$app->guide->chapter->allByParentId($id);
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], ['/guide']);
		if($id) {
			$breadcrumbs->create($entity->title, ['/guide/chapter/view', 'id' => $entity->id]);
		}
		return $this->render('index', compact('entity', 'collection'));
	}

}
