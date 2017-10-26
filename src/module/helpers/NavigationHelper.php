<?php

namespace yii2module\guide\module\helpers;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2mod\helpers\ArrayHelper;

class NavigationHelper {

	const URL_MODULE = '/guide';
	const URL_ARTICLE_VIEW = '/guide/article/view';
	const URL_ARTICLE_INDEX = '/guide/article';
	const URL_ARTICLE_CREATE = '/guide/article/create';
	const URL_ARTICLE_UPDATE = '/guide/article/update';
	const URL_ARTICLE_DELETE = '/guide/article/delete';
	const URL_ARTICLE_CODE = '/guide/article/code';
	const URL_CHAPTER_VIEW = '/guide/chapter/view';

	public function root() {
		$url = [self::URL_MODULE];
		Yii::$app->navigation->breadcrumbs->create(['guide/main', 'title'], $url);
	}

	public function project($id) {
		$project =$this->getEntity($id, 'project');
		$url = [self::URL_ARTICLE_INDEX, 'project_id' => $project->id];
		Yii::$app->navigation->breadcrumbs->create($project->title, $url);
	}

	public function article($id) {
		$article =$this->getEntity($id, 'article');
		$url = self::genUrl(self::URL_ARTICLE_VIEW, ['id' => $article->id]);
		Yii::$app->navigation->breadcrumbs->create($article->title, $url);
	}

	public function articleUpdate($id) {
		$article = $this->getEntity($id, 'article');
		$url = self::genUrl(self::URL_ARTICLE_UPDATE, ['id' => $article->id]);
		Yii::$app->navigation->breadcrumbs->create(['action', 'UPDATE'], $url);
	}

	public function articleCode($id) {
		$article = $this->getEntity($id, 'article');
		$url = self::genUrl(self::URL_ARTICLE_CODE, ['id' => $article->id]);
		Yii::$app->navigation->breadcrumbs->create(['action', 'CODE'], $url);
	}

	public function chapter($id) {
		$chapter =$this->getEntity($id, 'chapter');
		$url = self::genUrl(self::URL_CHAPTER_VIEW, ['id' => $chapter->id]);
		Yii::$app->navigation->breadcrumbs->create($chapter->title, $url);
	}

	public static function genUrl($baseUrl, $params = []) {
		$url = [];
		$url[] = $baseUrl;
		$url['project_id'] = Yii::$app->request->getQueryParam('project_id');
		if(!empty($params)) {
			foreach($params as $key => $value) {
				$url[$key] = $value;
			}
		}
		return $url;
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
