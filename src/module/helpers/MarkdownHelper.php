<?php

namespace yii2module\guide\module\helpers;

use Yii;
use Michelf\MarkdownExtra;
use yii2module\guide\module\helpers\filters\AlertFilter;
use yii2module\guide\module\helpers\filters\CodeFilter;
use yii2module\guide\module\helpers\filters\ImgFilter;
use yii2module\guide\module\helpers\filters\LinkFilter;
use yii2module\guide\module\helpers\filters\MarkFilter;

class MarkdownHelper {

	public static function toHtml($source) {
		$html = self::md2html($source);
		$html = static::filter($html);
		return $html;
	}

	private static function md2html($source) {
		$markdown = new MarkdownExtra();
		$html = $markdown->transform($source);
		return $html;
	}

	private static function filter($html) {
		$arr = [
			LinkFilter::className(),
			CodeFilter::className(),
			ImgFilter::className(),
			AlertFilter::className(),
			MarkFilter::className(),
		];
		foreach($arr as $className) {
			$html = static::runFilter($className, $html);
		}
		return $html;
	}

	private static function runFilter($className, $html) {
		$filterInstance = Yii::createObject($className);
		$html = $filterInstance->run($html);
		return $html;
	}

}
