<?php

namespace yii2module\guide\module\helpers;

use Yii;
use yii\helpers\Url;
use Michelf\MarkdownExtra;
use yii2lab\helpers\yii\Html;

class ViewHelper {

	public static function collectionToMap($collection) {
		$map = [];
		foreach($collection as $entity) {
			$map[$entity->group][] = $entity;
		}
		return $map;
	}

	public static function markdownToHtml($source) {
		$markdown = new MarkdownExtra();
		$html = $markdown->transform($source);
		$html = static::replaceInternalLink($html);
		$html = static::replaceExternalLink($html);
		$html = static::replaceImg($html);
		return $html;
	}

	public static function collectionToItems($collection, $url, $key = 'id') {
		$items = [];
		foreach($collection as $item) {
			if(is_array($key)) {
				$urlArray[$key[0]] = $item->{$key[1]};
			} else {
				$urlArray[$key] = $item->id;
			}
			$items[] = [
				'label' => $item->title,
				'url' => NavigationHelper::genUrl($url, $urlArray),
			];
		}
		return $items;
	}

	private static function replaceInternalLink($html) {
		$pattern = '~<a href="([^.]+).md">([^<]+)?</a>~';
		$callback = function ($matches) {
			$url = NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_VIEW);
			$url['id'] = $matches[1];
			return '<a href="'.Url::to($url).'">'.$matches[2].'</a>';
		};
		$html = preg_replace_callback($pattern, $callback, $html);
		return $html;
	}

	private static function replaceExternalLink($html) {
		$pattern = '~<a href="(http[^\"]+)">([^<]+)?</a>~';
		$replacement = '<a href="$1" target="_blank">$2</a>';
		$html = preg_replace($pattern, $replacement, $html);
		return $html;
	}

	private static function replaceImg($html) {
		$project_id = Yii::$app->request->getQueryParam('project_id');
		$project = Yii::$app->guide->project->oneById($project_id);
		$pattern = '~<img src="([\w/]+).(png|jpg|jpeg|gif)"([^\>]+)>~';
		$html = preg_replace_callback($pattern, function($matches) use($project) {
			$name = $matches[1];
			$extension = $matches[2];
			$fileName = ROOT_DIR . DS . $project->dir . DS . $name . '.' . $extension;
			$data = Html::getDataUrl($fileName);
			return "<img src=\"{$data}\"{$matches[3]}>";
		}, $html);
		return $html;
	}
}
