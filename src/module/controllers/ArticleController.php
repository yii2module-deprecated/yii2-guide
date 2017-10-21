<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;

class ArticleController extends Controller {
	
	public function actionIndex($project_id) {
		$this->module->navigation->project($project_id);
		$entity = Yii::$app->guide->article->oneMain();
		return $this->render('index', compact('entity'));
	}

	public function actionView($project_id, $id = null) {
		$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
		$this->module->navigation->project($project_id);
		if($id) {
			$this->module->navigation->chapter($entity->chapter->parent);
			$this->module->navigation->article($entity);
		}
		return $this->render('index', compact('entity'));
	}

}
