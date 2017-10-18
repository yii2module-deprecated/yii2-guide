<?php

namespace yii2module\guide\domain\helpers;

class ArticleHelper {
	
	public static function replaceLink($html) {
		$pattern = '~<a href="([^.]+).md">([^<]+)?</a>~';
		$replacement = '<a href="/guide/default/view?id=$1">$2</a>';
		$html = preg_replace($pattern, $replacement, $html);
		return $html;
	}

}
