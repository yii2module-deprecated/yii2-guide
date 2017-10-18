<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller {
	
	public function actionIndex() {
		$entity = Yii::$app->guide->article->oneMain();
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], ['/guide']);
		return $this->render('index', compact('entity'));
	}

	public function actionView($id = null) {
		$entity = Yii::$app->guide->article->oneById($id);
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], ['/guide']);
		if($id) {
			$chapter = Yii::$app->guide->chapter->oneByArticleId($id);
			$breadcrumbs->create($chapter->parent->title, ['/guide/chapter/view', 'id' => $chapter->parent->id]);
			$breadcrumbs->create($entity->title, ['/guide', 'id' => $entity->id]);
		}
		return $this->render('index', compact('entity'));
	}

}
