<?php

namespace yii2module\guide\domain\helpers;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2mod\helpers\ArrayHelper;
use yii2module\guide\module\Module;

class NavigationHelper {

	public static function root() {
		Yii::$app->navigation->breadcrumbs->create(['guide/main', 'title'], [Module::URL_MODULE]);
	}

	public static function project($id) {
		$project = static::getEntity($id, 'project');
		Yii::$app->navigation->breadcrumbs->create($project->title, [Module::URL_ARTICLE_INDEX, 'project_id' => $project->id]);
	}

	public static function article($id) {
		$article = static::getEntity($id, 'article');
		Yii::$app->navigation->breadcrumbs->create($article->title);
	}

	public static function chapter($id) {
		$chapter = static::getEntity($id, 'chapter');
		Yii::$app->navigation->breadcrumbs->create($chapter->title, ArticleHelper::genUrl(Module::URL_CHAPTER_VIEW, ['id' => $chapter->id]));
	}

	private static function getEntity($id, $serviceName) {
		if($id instanceof BaseEntity) {
			$entity = $id;
		} else {
			$service = ArrayHelper::getValue(Yii::$app, 'guide.' . $serviceName);
			$entity = $service->oneById($id);
		}
		return $entity;
	}
}
