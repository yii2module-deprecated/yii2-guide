<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\module\Module;

class DefaultController extends Controller {
	
	public function actionIndex() {
		$entity = Yii::$app->guide->article->oneMain();
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], [Module::URL_ARTICLE_INDEX]);
		return $this->render('index', compact('entity'));
	}

	public function actionView($id = null) {
		$entity = Yii::$app->guide->article->oneById($id);
		$breadcrumbs = Yii::$app->navigation->breadcrumbs;
		$breadcrumbs->create(['guide/main', 'title'], [Module::URL_ARTICLE_INDEX]);
		if($id) {
			$chapter = Yii::$app->guide->chapter->oneByArticleId($id);
			$breadcrumbs->create($chapter->parent->title, [Module::URL_CHAPTER_VIEW, 'id' => $chapter->parent->id]);
			$breadcrumbs->create($entity->title, [Module::URL_ARTICLE_VIEW, 'id' => $entity->id]);
		}
		return $this->render('index', compact('entity'));
	}

}
