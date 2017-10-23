<?php

namespace yii2module\guide\module\helpers;

use yii\helpers\Url;
use Michelf\MarkdownExtra;

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
}
