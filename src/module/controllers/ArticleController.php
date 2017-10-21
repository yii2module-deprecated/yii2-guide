<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\domain\helpers\NavigationHelper;

class ArticleController extends Controller {
	
	public function actionIndex($project_id) {
		Yii::$app->guide->article->setProject($project_id);
		NavigationHelper::project($project_id);
		$entity = Yii::$app->guide->article->oneMain();
		return $this->render('index', compact('entity'));
	}

	public function actionView($project_id, $id = null) {
		Yii::$app->guide->article->setProject($project_id);
		//prr($project,1,1);
		$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
		NavigationHelper::project($project_id);
		if($id) {
			NavigationHelper::chapter($entity->chapter->parent);
			NavigationHelper::article($entity);
		}
		return $this->render('index', compact('entity'));
	}

}
