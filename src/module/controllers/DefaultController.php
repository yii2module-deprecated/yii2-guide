<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\data\DataProviderInterface;
use yii\helpers\Url;
use yii\web\Controller;
use yii2module\guide\module\forms\SearchForm;

class DefaultController extends Controller {
	
	public function actionIndex() {
		$collection = Yii::$app->guide->project->all();
		return $this->render('list', compact('collection'));
	}
	
	public function actionSearch() {
		Yii::$app->navigation->breadcrumbs->create(Yii::t('action', 'search'), Url::to(['/guide/search']));
		$dataProvider = null;
		$model = new SearchForm();
		if(Yii::$app->request->isPost) {
			$body = Yii::$app->request->post('SearchForm');
			$model->setAttributes($body, false);
			Yii::$app->navigation->breadcrumbs->create($body['text']);
			/** @var DataProviderInterface $dataProvider */
			$dataProvider = Yii::$app->guide->article->search($body);
		}
		return $this->render('search', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);
	}

}
