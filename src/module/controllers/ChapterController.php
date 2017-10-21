<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;
use yii2module\guide\domain\helpers\NavigationHelper;

class ChapterController extends Controller {

	public function actionView($project_id, $id = null) {
		NavigationHelper::project($project_id);
		$entity = Yii::$app->guide->chapter->oneByIdWithArticles($id);
		if($id) {
			Yii::$app->navigation->breadcrumbs->create($entity->title/*, [Module::URL_CHAPTER_VIEW, 'id' => $entity->id]*/);
		}
		return $this->render('index', compact('entity'));
	}

}
