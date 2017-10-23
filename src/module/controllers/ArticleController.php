<?php

namespace yii2module\guide\module\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\guide\domain\entities\ArticleEntity;
use yii2module\guide\module\forms\ArticleForm;
use yii2module\guide\module\helpers\NavigationHelper;

class ArticleController extends Controller {

	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['update', 'delete'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['guide.modify'],
					],
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
			$chapter = Yii::$app->guide->repositories->chapter->oneByArticleId($id);
			return $this->render('viewNotFound', compact('project_id', 'id'));
		}
	}

	public function actionUpdate($project_id, $id) {
		$model = new ArticleForm();
		$body = Yii::$app->request->post('ArticleForm');
		if($body) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try{
					$data['id'] = $id;
					$data['md'] = $body['md'];
					Yii::$app->guide->article->updateInProject($data, $project_id);
					Yii::$app->notify->flash->send(['main', 'update_success'], Alert::TYPE_SUCCESS);
					return $this->redirect(NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_VIEW, compact('project_id', 'id')));
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			/** @var ArticleEntity $entity */
			try {
				$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
			} catch(NotFoundHttpException $e) {
				$entity = Yii::$app->guide->factory->entity->create($this->id, ['id' => $id]);
			}
			$model->setAttributes($entity->toArray(), false);
		}
		if($id) {
			$this->module->navigation->project($project_id);
			if(is_object($entity->chapter)) {
				$this->module->navigation->chapter($entity->chapter->parent);
			}
			$this->module->navigation->article($entity);
			$this->module->navigation->articleUpdate($entity);
		}
		return $this->render('update', ['model' => $model]);
	}

}
