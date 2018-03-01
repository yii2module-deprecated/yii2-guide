<?php

namespace yii2module\guide\module\controllers;

use common\enums\rbac\PermissionEnum;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\helpers\Behavior;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\guide\domain\entities\ArticleEntity;
use yii2module\guide\module\forms\ArticleForm;
use yii2module\guide\module\helpers\NavigationHelper;

class ArticleController extends Controller {

	public function behaviors() {
		return [
			'access' => Behavior::access(PermissionEnum::GUIDE_MODIFY, ['update', 'delete']),
		];
	}

	public function actionIndex() {
		$entity = Yii::$app->guide->article->oneMain();
		return $this->render('view', compact('entity'));
	}

	public function actionView($id = null) {
		try {
			if($id) {
				$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
				$this->module->navigation->articleAndChapter($entity);
			}
			return $this->render('view', compact('entity'));
		} catch(NotFoundHttpException $e) {
			$chapter = Yii::$app->guide->repositories->chapter->oneByArticleId($id);
			return $this->render('viewNotFound', compact('id'));
		}
	}

	public function actionCode($id) {
		$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
		$this->module->navigation->articleAndChapter($entity);
		$this->module->navigation->articleCode($entity);
		return $this->render('code', compact('entity'));
	}

	public function actionUpdate($id) {
		$model = new ArticleForm();
		if(Yii::$app->request->isPost) {
			$body = Yii::$app->request->post('ArticleForm');
			$isPreview = Yii::$app->request->post('isPreview');
			$model->setAttributes($body, false);
			if($model->validate()) {
				if($isPreview) {
					try {
						$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
					} catch(NotFoundHttpException $e) {
						$entity = Yii::$app->guide->factory->entity->create($this->id, ['id' => $id]);
					}
				} else {
					try{
						$data['id'] = $id;
						$data['content'] = $body['content'];
						Yii::$app->guide->article->update($data);
						Yii::$app->navigation->alert->create(['main', 'update_success'], Alert::TYPE_SUCCESS);
						return $this->redirect(NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_VIEW, compact('project_id', 'id')));
					} catch (UnprocessableEntityHttpException $e){
						$model->addErrorsFromException($e);
					}
				}
			}
		} else {
			try {
				$entity = Yii::$app->guide->article->oneByIdWithChapter($id);
			} catch(NotFoundHttpException $e) {
				$entity = Yii::$app->guide->factory->entity->create($this->id, ['id' => $id]);
			}
			$model->setAttributes($entity->toArray(), false);
		}
		if($id) {
			/** @var ArticleEntity $entity */
			$this->module->navigation->articleAndChapter($entity);
			$this->module->navigation->articleUpdate($entity);
		}
		return $this->render('update', ['model' => $model]);
	}

}
