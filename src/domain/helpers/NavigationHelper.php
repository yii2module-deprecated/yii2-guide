<?php

namespace yii2module\guide\domain\helpers;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2mod\helpers\ArrayHelper;
use yii2module\guide\module\Module;

class NavigationHelper {

	public function root() {
		$url = [Module::URL_MODULE];
		Yii::$app->navigation->breadcrumbs->create(['guide/main', 'title'], $url);
	}

	public function project($id) {
		$project =$this->getEntity($id, 'project');
		$url = [Module::URL_ARTICLE_INDEX, 'project_id' => $project->id];
		Yii::$app->navigation->breadcrumbs->create($project->title, $url);
	}

	public function article($id) {
		$article =$this->getEntity($id, 'article');
		$url = ArticleHelper::genUrl(Module::URL_ARTICLE_VIEW, ['id' => $article->id]);
		Yii::$app->navigation->breadcrumbs->create($article->title, $url);
	}

	public function chapter($id) {
		$chapter =$this->getEntity($id, 'chapter');
		$url = ArticleHelper::genUrl(Module::URL_CHAPTER_VIEW, ['id' => $chapter->id]);
		Yii::$app->navigation->breadcrumbs->create($chapter->title, $url);
	}

	private function getEntity($id, $serviceName) {
		if($id instanceof BaseEntity) {
			$entity = $id;
		} else {
			$service = ArrayHelper::getValue(Yii::$app, 'guide.' . $serviceName);
			$entity = $service->oneById($id);
		}
		return $entity;
	}
}
