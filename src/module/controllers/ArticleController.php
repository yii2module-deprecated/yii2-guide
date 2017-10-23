<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2module\guide\module\helpers\NavigationHelper;

class ArticleController extends Controller {

	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['create'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['guide.create'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'create' => ['post'],
				],
			],
		];
	}

	public function actionIndex($project_id) {
		$this->module->navigation->project($project_id);
		$entity = Yii::$app->guide->article->oneMain();
		return $this->render('view', compact('entity'));
	}

	public function actionView($project_id, $id = null) {
		try {
			$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
			$this->module->navigation->project($project_id);
			if($id) {
				$this->module->navigation->chapter($entity->chapter->parent);
				$this->module->navigation->article($entity);
			}
			return $this->render('view', compact('entity'));
		} catch(NotFoundHttpException $e) {
			return $this->render('create', compact('project_id', 'id'));
		}
	}

	public function actionCreate($project_id, $id = null) {
		Yii::$app->guide->article->createInProject($id, $project_id);
		return $this->redirect(NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_VIEW, compact('project_id', 'id')));
	}

}
