<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\domain\helpers\NavigationHelper;

class ChapterController extends Controller {

	public function actionView($project_id, $id = null) {
		Yii::$app->guide->article->setProject($project_id);
		NavigationHelper::project($project_id);
		$entity = Yii::$app->guide->chapter->oneByIdWithArticles($id);
		if($id) {
			NavigationHelper::chapter($entity);
		}
		return $this->render('index', compact('entity'));
	}

}
