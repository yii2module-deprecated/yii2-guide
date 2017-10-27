<?php

namespace yii2module\guide\module\widgets;

use yii\apidoc\templates\bootstrap\assets\AssetBundle;
use yii\base\Widget;
use yii2module\guide\module\helpers\FilterHelper;
use yii2module\guide\module\helpers\MarkdownHelper;

class Markdown extends Widget {

	public $content;
	public $filters = [
		'yii2module\guide\module\helpers\filters\AlertFilter',
		'yii2module\guide\module\helpers\filters\CodeFilter',
		'yii2module\guide\module\helpers\filters\ImgFilter',
		'yii2module\guide\module\helpers\filters\LinkFilter',
		'yii2module\guide\module\helpers\filters\MarkFilter',
	];

	public function init() {
		parent::init();
		$this->registerAssets();
	}

	public function run() {
		$html = MarkdownHelper::toHtml($this->content);
		$html = FilterHelper::run($html, $this->filters);
		return $html;
	}

	protected function registerAssets() {
		$view = $this->getView();
		AssetBundle::register($view);
	}

}