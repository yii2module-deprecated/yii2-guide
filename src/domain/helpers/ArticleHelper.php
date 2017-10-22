<?php

namespace yii2module\guide\domain\helpers;

use Yii;

class ArticleHelper {

	public static function extractTileFromMarkdown($code) {
		$code = strip_tags($code);
		$md = trim($code);
		$lines = preg_split('~(\n|\r\n)~', $md);
		$firstLine = $lines[0];
		return trim($firstLine, ' #');
	}

}
