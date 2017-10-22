<?php

namespace yii2module\guide\module;

use Yii;
use yii\base\Module as YiiModule;
use yii2module\guide\domain\helpers\NavigationHelper;

class Module extends YiiModule
{

	public $navigation;

	public function init() {
		parent::init();
		$this->initNavigation();
		$this->initProject();
	}

	private function initNavigation() {
		$this->navigation = Yii::createObject(NavigationHelper::class);
		$this->navigation->root();
		Yii::$app->navigation->breadcrumbs->removeLastUrl();
	}

	private function initProject() {
		$project_id = Yii::$app->request->getQueryParam('project_id');
		if($project_id) {
			Yii::$app->guide->article->setProject($project_id);
		}
	}
}
