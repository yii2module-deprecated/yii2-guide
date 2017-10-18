<?php

namespace yii2module\guide\domain\helpers;

use yii2module\guide\module\Module;

class ArticleHelper {

	public static function collectionToItems($articles) {
		$items = [];
		foreach($articles as $item) {
			$items[] = [
				'label' => $item->title,
				'url' => [Module::URL_ARTICLE_VIEW, 'id' => $item->id],
			];
		}
		return $items;
	}

	public static function replaceLink($html) {
		$pattern = '~<a href="([^.]+).md">([^<]+)?</a>~';
		$replacement = '<a href="'.Module::URL_ARTICLE_VIEW.'?id=$1">$2</a>';
		$html = preg_replace($pattern, $replacement, $html);
		return $html;
	}

}
