<?php

namespace yii2module\guide\domain\helpers;

use Yii;
use yii\helpers\Url;

class ArticleHelper {

	public static function extractTileFromMarkdown($code) {
		$code = strip_tags($code);
		$md = trim($code);
		$lines = preg_split('~(\n|\r\n)~', $md);
		$firstLine = $lines[0];
		return trim($firstLine, ' #');
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
				'url' => static::genUrl($url, $urlArray),
			];
		}
		return $items;
	}

	public static function replaceLink($html) {
		$html = static::replaceInternalLink($html);
		$html = static::replaceExternalLink($html);
		return $html;
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

	private static function replaceInternalLink($html) {
		$pattern = '~<a href="([^.]+).md">([^<]+)?</a>~';
		$callback = function ($matches) {
			$url = static::genUrl(NavigationHelper::URL_ARTICLE_VIEW);
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
