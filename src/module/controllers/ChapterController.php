<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;

class ChapterController extends Controller {

	public function actionView($project_id, $id = null) {
		$this->module->navigation->project($project_id);
		$entity = Yii::$app->guide->chapter->oneByIdWithArticles($id);
		if($id) {
			$this->module->navigation->chapter($entity);
		}
		return $this->render('list', compact('entity'));
	}

}
