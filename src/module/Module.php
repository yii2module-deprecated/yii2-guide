<?php

namespace yii2module\guide\module;

use Yii;
use yii\base\Module as YiiModule;
use yii2module\guide\domain\helpers\NavigationHelper;

class Module extends YiiModule
{

	const URL_MODULE = '/guide';
	const URL_ARTICLE_VIEW = '/guide/article/view';
	const URL_ARTICLE_INDEX = '/guide/article';
	const URL_CHAPTER_VIEW = '/guide/chapter/view';

	public $navigation;

	public function init() {
		parent::init();
		$this->navigation = Yii::createObject(NavigationHelper::class);
		$this->navigation->root();
		Yii::$app->navigation->breadcrumbs->removeLastUrl();
		$this->initProject();
	}

	private function initProject() {
		$project_id = Yii::$app->request->getQueryParam('project_id');
		if($project_id) {
			Yii::$app->guide->article->setProject($project_id);
		}
	}
}
