<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\module\Module;

class DefaultController extends Controller {
	
	public function actionIndex() {
		$entity = Yii::$app->guide->article->oneMain();
		return $this->render('index', compact('entity'));
	}

	public function actionView($id = null) {
		$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
		if($id) {
			$breadcrumbs = Yii::$app->navigation->breadcrumbs;
			$breadcrumbs->create($entity->chapter->parent->title, [Module::URL_CHAPTER_VIEW, 'id' => $entity->chapter->parent->id]);
			$breadcrumbs->create($entity->title, [Module::URL_ARTICLE_VIEW, 'id' => $entity->id]);
		}
		return $this->render('index', compact('entity'));
	}

}
