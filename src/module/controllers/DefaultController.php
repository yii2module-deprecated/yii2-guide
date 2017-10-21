<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller {
	
	public function actionIndex() {
		$collection = Yii::$app->guide->project->all();
		return $this->render('list', compact('collection'));
	}

}
