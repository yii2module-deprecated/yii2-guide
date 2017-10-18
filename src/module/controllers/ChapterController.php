<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\module\Module;

class ChapterController extends Controller {

	public function actionView($id = null) {
		$entity = Yii::$app->guide->chapter->oneByIdWithArticles($id);
		if($id) {
			Yii::$app->navigation->breadcrumbs->create($entity->title/*, [Module::URL_CHAPTER_VIEW, 'id' => $entity->id]*/);
		}
		return $this->render('index', compact('entity'));
	}

}
